<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trashcan extends Model
{
    //
    protected $fillable = ['name', 'api_key'];

    public function data()
    {
        return $this->hasMany(TrashcanData::class);
    }
}
