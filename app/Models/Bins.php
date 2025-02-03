<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bins extends Model
{
    //
    use HasUuids;
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [

        'id','name', 'location', 'latitude', 'longitude',
        'fill_level', 'battery_level', 'signal_strength',
        'is_connected', 'last_communication'
    ];

    protected $casts = [
        'last_communication' => 'datetime',
    ];

    public function data() {
        return $this->hasMany(Bin_data::class);
    }

    public function alerts() {
        return $this->hasMany(Bin_alert::class);
    }

    public function maintenanceLogs() {
        return $this->hasMany(Maintenance_Log::class);
    }

    public function assignedUsers() {
        return $this->belongsToMany(User::class, 'assigned_bins', 'bin_id', 'user_id');
    }

}
