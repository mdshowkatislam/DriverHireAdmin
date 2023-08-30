<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function getProfilePhotoPathAttribute()
    {
        if ( empty($this->attributes['profile_photo_path']) ){
            $firstName = $this->attributes['first_name'];
            $firstChar = mb_substr($firstName, 0, 1);
            return 'https://ui-avatars.com/api/?name='.urlencode($firstChar).'&color=7F9CF5&background=EBF4FF';
        } else {
            return $this->attributes['profile_photo_path'];
        }
    }
}
