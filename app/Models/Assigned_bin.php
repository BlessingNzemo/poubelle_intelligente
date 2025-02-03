<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assigned_bin extends Model
{
    //

    protected $fillable = ['bin_id', 'user_id'];
    
    public $incrementing = false;
    protected $keyType = 'string';

}
