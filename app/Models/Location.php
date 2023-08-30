<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable  = [
        'user_id', 'lat', 'lng'
    ];

    protected $hidden = ['updated_at'];

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['created_at']));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
