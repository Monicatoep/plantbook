<?php

namespace App\Console\Commands;

use App\Models\PlantSpecies;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:sync-plant-species {--pages=5 : Number of pages to fetch}')]
#[Description('Fetch plant species from the Perenual API and store them locally')]
class SyncPlantSpecies extends Command
{
    public function handle(): int
    {
        $apiKey = config('services.perenual.key');

        if (! $apiKey) {
            $this->error('PERENUAL_API_KEY is not set.');

            return self::FAILURE;
        }

        $pages = (int) $this->option('pages');
        $totalSynced = 0;

        for ($page = 1; $page <= $pages; $page++) {
            $this->info("Fetching page {$page}...");

            $response = Http::withoutVerifying()->get('https://perenual.com/api/v2/species-list', [
                'key' => $apiKey,
                'page' => $page,
            ]);

            if ($response->failed()) {
                $this->error("Failed to fetch page {$page}: {$response->status()}");

                return self::FAILURE;
            }

            $data = $response->json('data', []);

            if (empty($data)) {
                $this->info('No more data to fetch.');
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

            if ($page >= $response->json('last_page', $pages)) {
                break;
            }
        }

        $this->info("Synced {$totalSynced} species.");

        return self::SUCCESS;
    }
}
