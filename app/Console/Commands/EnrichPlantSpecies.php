<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

#[Signature('app:enrich-plant-species')]
#[Description('Fetch detailed species data from the Perenual API and store in the backup database')]
class EnrichPlantSpecies extends Command
{
    public function handle(): int
    {
        $apiKey = config('services.perenual.key');

        if (! $apiKey) {
            $this->error('PERENUAL_API_KEY is not set.');

            return self::FAILURE;
        }

        if (! Schema::connection('species')->hasTable('plant_species')) {
            $this->error('Backup database has no plant_species table. Run app:sync-plant-species first.');

            return self::FAILURE;
        }

        $species = DB::connection('species')->table('plant_species')
            ->whereNull('watering')
            ->orWhereNull('sunlight')
            ->orWhereNull('cycle')
            ->get();

        if ($species->isEmpty()) {
            $this->info('All species already have watering, sunlight, and cycle data.');

            return self::SUCCESS;
        }

        $this->info("Enriching {$species->count()} species...");
        $bar = $this->output->createProgressBar($species->count());
        $bar->start();

        $enriched = 0;

        foreach ($species as $plant) {
            $response = Http::withoutVerifying()
                ->retry(3, 60000, throw: false)
                ->get("https://perenual.com/api/v2/species/details/{$plant->perenual_id}", [
                    'key' => $apiKey,
                ]);

            if ($response->status() === 429) {
                $retryAfter = $response->json('Retry-After', 60);
                $this->newLine();
                $this->warn("Rate limited. Waiting {$retryAfter} seconds...");
                sleep($retryAfter);

                $response = Http::withoutVerifying()
                    ->get("https://perenual.com/api/v2/species/details/{$plant->perenual_id}", [
                        'key' => $apiKey,
                    ]);
            }

            if ($response->failed()) {
                $this->newLine();
                $this->warn("Failed to fetch details for {$plant->common_name} (ID: {$plant->perenual_id}): {$response->status()}");
                $bar->advance();

                continue;
            }

            $data = $response->json();

            DB::connection('species')->table('plant_species')
                ->where('perenual_id', $plant->perenual_id)
                ->update([
                    'cycle' => $data['cycle'] ?? $plant->cycle,
                    'watering' => $data['watering'] ?? $plant->watering,
                    'sunlight' => is_array($data['sunlight'] ?? null)
                        ? implode(', ', $data['sunlight'])
                        : ($data['sunlight'] ?? $plant->sunlight),
                    'updated_at' => now(),
                ]);

            $enriched++;
            $bar->advance();
            sleep(1);
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Enriched {$enriched} species in backup database.");
        $this->info('Run app:restore-plant-species to copy them to the main database.');

        return self::SUCCESS;
    }
}
