<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance_log extends Model
{
    //
    protected $fillable = ['bin_id', 'user_id', 'intervention_type', 'notes'];

    public function bin()
    {
        return $this->belongsTo(Bins::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
