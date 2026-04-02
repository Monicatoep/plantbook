<?php

namespace App\Console\Commands;

use App\Models\PlantSpecies;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

#[Signature('app:sync-plant-species')]
#[Description('Fetch all plant species from the Perenual API and store them locally')]
class SyncPlantSpecies extends Command
{
    public function handle(): int
    {
        $apiKey = config('services.perenual.key');

        if (! $apiKey) {
            $this->error('PERENUAL_API_KEY is not set.');

            return self::FAILURE;
        }

        $page = 1;
        $lastPage = 1;
        $totalSynced = 0;

        do {
            $this->info("Fetching page {$page} of {$lastPage}...");

            $response = Http::withoutVerifying()
                ->retry(3, 60000, when: fn ($e, $request) => $e instanceof RequestException && $e->response->status() === 429)
                ->get('https://perenual.com/api/v2/species-list', [
                    'key' => $apiKey,
                    'page' => $page,
                ]);

            if ($response->failed()) {
                $this->error("Failed to fetch page {$page}: {$response->status()}");

                return self::FAILURE;
            }

            $lastPage = $response->json('last_page', 1);
            $data = $response->json('data', []);

            if (empty($data)) {
                break;
            }

            foreach ($data as $species) {
                PlantSpecies::updateOrCreate(
                    ['perenual_id' => $species['id']],
                    [
                        'common_name' => $species['common_name'] ?? 'Unknown',
                        'scientific_name' => $species['scientific_name'] ?? null,
                        'other_name' => $species['other_name'] ?? null,
                        'family' => $species['family'] ?? null,
                        'genus' => $species['genus'] ?? null,
                        'cycle' => $species['cycle'] ?? null,
                        'watering' => $species['watering'] ?? null,
                        'sunlight' => is_array($species['sunlight'] ?? null) ? implode(', ', $species['sunlight']) : ($species['sunlight'] ?? null),
                        'image_url' => $species['default_image']['original_url'] ?? null,
                        'thumbnail_url' => $species['default_image']['thumbnail'] ?? null,
                    ],
                );

                $totalSynced++;
            }

            $page++;
            sleep(1);
        } while ($page <= $lastPage);

        $this->info("Synced {$totalSynced} species.");

        return self::SUCCESS;
    }
}
