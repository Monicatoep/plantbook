<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

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

        $this->ensureBackupTableExists();

        $page = 1;
        $lastPage = 1;
        $totalSynced = 0;

        do {
            $this->info("Fetching page {$page} of {$lastPage}...");

            $response = Http::withoutVerifying()
                ->retry(3, 60000, throw: false)
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
                $row = [
                    'perenual_id' => $species['id'],
                    'common_name' => $species['common_name'] ?? 'Unknown',
                    'scientific_name' => json_encode($species['scientific_name'] ?? null),
                    'other_name' => json_encode($species['other_name'] ?? null),
                    'family' => $species['family'] ?? null,
                    'genus' => $species['genus'] ?? null,
                    'cycle' => $species['cycle'] ?? null,
                    'watering' => $species['watering'] ?? null,
                    'sunlight' => is_array($species['sunlight'] ?? null) ? implode(', ', $species['sunlight']) : ($species['sunlight'] ?? null),
                    'image_url' => $species['default_image']['original_url'] ?? null,
                    'thumbnail_url' => $species['default_image']['thumbnail'] ?? null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ];

                DB::connection('species')->table('plant_species')->updateOrInsert(
                    ['perenual_id' => $species['id']],
                    $row,
                );

                $totalSynced++;
            }

            $page++;
            sleep(1);
        } while ($page <= $lastPage);

        $this->info("Synced {$totalSynced} species to backup.");

        return self::SUCCESS;
    }

    private function ensureBackupTableExists(): void
    {
        if (Schema::connection('species')->hasTable('plant_species')) {
            return;
        }

        Schema::connection('species')->create('plant_species', function ($table) {
            $table->id();
            $table->unsignedInteger('perenual_id')->unique();
            $table->string('common_name');
            $table->json('scientific_name')->nullable();
            $table->json('other_name')->nullable();
            $table->string('family')->nullable();
            $table->string('genus')->nullable();
            $table->string('cycle')->nullable();
            $table->string('watering')->nullable();
            $table->string('sunlight')->nullable();
            $table->string('image_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->timestamps();
        });
    }
}
