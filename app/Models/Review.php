<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    protected $appends = ['rate_by_info', 'rate_to_info', 'hire_request_info'];

    public function getRateByInfoAttribute()
    {
        return (isset($this->rate_by)) ? User::find($this->rate_by) : null;
    }

    public function getRateToInfoAttribute()
    {
        return (isset($this->rate_to)) ? User::find($this->rate_to) : null;
    }

    public function getHireRequestInfoAttribute()
    {
        return (isset($this->hire_request_id)) ? HireRequest::find($this->hire_request_id) : null;
    }

    public function hireRequest()
    {
        return $this->belongsTo(HireRequest::class, 'hire_request_id');
    }


    public function rateBy()
    {
        return $this->belongsTo(User::class, 'rate_by');
    }

    public function rateTo()
    {
        return $this->belongsTo(User::class, 'rate_to');
    }
}
