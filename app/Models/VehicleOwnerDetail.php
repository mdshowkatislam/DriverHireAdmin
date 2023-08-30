<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleOwnerDetail extends Model
{
    use HasFactory;

    protected $hidden = ['updated_at'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'v_owner_id');
    }


    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i a', strtotime($this->attributes['created_at']));
    }

}
