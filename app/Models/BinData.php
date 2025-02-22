<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BinData extends Model
{
    use HasFactory;

    protected $fillable = [
        'bin_id',
        'latitude',
        'longitude',
        'fill_level',
        'temperature',
        'humidity',
        'is_open'
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s' // Format pour les API
    ];
}
