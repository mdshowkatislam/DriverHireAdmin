<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    protected $appends = ['driver_info', 'hire_request_info'];

    public function getDriverInfoAttribute()
    {
        return (isset($this->driver_id  )) ? User::find($this->driver_id ) : null;
    }

    public function getHireRequestInfoAttribute()
    {
        return (isset($this->hire_request_id )) ? HireRequest::find($this->hire_request_id) : null;
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function hireRequest()
    {
        return $this->belongsTo(HireRequest::class, 'hire_request_id');
    }
}
