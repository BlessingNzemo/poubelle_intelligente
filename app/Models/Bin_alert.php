<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bin;

class Bin_alert extends Model
{
    //
    protected $fillable = ['bin_id', 'type', 'message', 'resolved_at'];

    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }
}
