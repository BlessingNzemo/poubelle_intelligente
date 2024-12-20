<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrashcanData extends Model
{
    //q
    protected $fillable = ['trashcan_id', 'fill_percentage', 'latitude', 'longitude', 'is_full'];

    public function trashcan()
    {
        return $this->belongsTo(Trashcan::class);
    }

}
