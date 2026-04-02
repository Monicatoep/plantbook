<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantSpecies extends Model
{
    protected $fillable = [
        'perenual_id',
        'common_name',
        'scientific_name',
        'other_name',
        'family',
        'genus',
        'cycle',
        'watering',
        'sunlight',
        'image_url',
        'thumbnail_url',
    ];

    protected function casts(): array
    {
        return [
            'scientific_name' => 'array',
            'other_name' => 'array',
        ];
    }
}
