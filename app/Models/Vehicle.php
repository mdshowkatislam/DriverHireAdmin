<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    protected $hidden = ['updated_at'];


    public function getCreatedAtAttribute()
    {
        return formatDate($this->attributes['created_at']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
