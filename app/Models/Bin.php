<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'name',
        'location',
        'user_id',
    ];

    protected $casts = [
        'last_communication' => 'datetime',
    ];

    public function binDatas()
    {
        return $this->hasMany(BinData::class, 'bin_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
