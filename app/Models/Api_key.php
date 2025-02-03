<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Api_key extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'key'];

    protected static function booted()
    {
        static::creating(function ($apiKey) {
            $apiKey->key = Str::random(64);
        });
    }
}
