<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['_token'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['role', 'total_trip', 'total_income', 'total_expense'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }


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


    public function getRoleAttribute()
    {
        return ( isset($this->attributes['role_id']) ) ? Role::find($this->attributes['role_id']) : null;
    }
    public function driverInfo()
    {
        return $this->hasOne(DriverDetail::class, 'id');
    }
    public function ownerInfo()
    {
        return $this->hasOne(VehicleOwnerDetail::class, 'id');
    }


    public function getTotalTripAttribute()
    {
        if ( $this->attributes['role_id']){
            if ( roleNameById($this->attributes['role_id']) == 'driver' ){
                return HireRequest::where([
                    'bid_winner_id' => $this->attributes['id'],
                    'hire_status' => 'ride_completed'
                ])->count();
            } else {
                return HireRequest::where([
                    'v_owner_id' => $this->attributes['id'],
                    'hire_status' => 'ride_completed'
                ])->count();
            }

        }
        return 0;
    }


    public function getTotalIncomeAttribute()
    {
        if ( $this->attributes['role_id']){
            if ( roleNameById($this->attributes['role_id']) == 'driver' ){
                return totalIncome($this->attributes['id']);
            }
        }
        return 0;
    }


    public function getTotalExpenseAttribute()
    {
        if ( $this->attributes['role_id']){
            if ( roleNameById($this->attributes['role_id']) != 'driver' ){
                return totalExpense($this->attributes['id']);
            }
        }
        return 0;
    }

}
