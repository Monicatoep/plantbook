<?php

namespace App\Console\Commands;

use App\Models\PlantSpecies;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

#[Signature('app:restore-plant-species')]
#[Description('Restore plant species from the backup database into the main database')]
class RestorePlantSpecies extends Command
{
    public function handle(): int
    {
        if (! Schema::connection('species')->hasTable('plant_species')) {
            $this->error('Backup database has no plant_species table. Run app:sync-plant-species first.');

            return self::FAILURE;
        }

        $count = DB::connection('species')->table('plant_species')->count();

        if ($count === 0) {
            $this->error('Backup database is empty. Run app:sync-plant-species first.');

            return self::FAILURE;
        }

        $this->info("Restoring {$count} species from backup...");

        DB::connection('species')->table('plant_species')->orderBy('id')->chunk(100, function ($rows) {
            foreach ($rows as $row) {
                PlantSpecies::updateOrCreate(
                    ['perenual_id' => $row->perenual_id],
                    [
                        'common_name' => $row->common_name,
                        'scientific_name' => json_decode($row->scientific_name, true),
                        'other_name' => json_decode($row->other_name, true),
                        'family' => $row->family,
                        'genus' => $row->genus,
                        'cycle' => $row->cycle,
                        'watering' => $row->watering,
                        'sunlight' => $row->sunlight,
                        'image_url' => $row->image_url,
                        'thumbnail_url' => $row->thumbnail_url,
                    ],
                );
            }
        });

        $this->info("Restored {$count} species.");

        return self::SUCCESS;
    }
}
