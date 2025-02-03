<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bin_data extends Model
{
    //
    use HasFactory;

    protected $fillable = ['fill_level', 'temperature', 'battery_voltage', 'sensor_data'];

    protected $casts = [
        'sensor_data' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s' // Format pour les API
    ];
}
