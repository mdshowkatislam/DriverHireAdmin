<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverOnlineLog extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    public function getDriverAttribute()
    {
        return ( isset( $this->attributes['driver_id'] ) ) ? User::find($this->attributes['driver_id']) : null;
    }

    public function driverInfo()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
