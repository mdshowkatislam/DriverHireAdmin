<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireRequest extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    protected $hidden = [
        'updated_at'
    ];


    public function vehicleOwner()
    {
        return $this->belongsTo(User::class, 'v_owner_id');
    }


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'v_id');
    }


    public function bidWinner()
    {
        return $this->belongsTo(User::class, 'bid_winner_id');
    }

    public function bidWinnerTotalIncome()
    {
        return $this->acceptedBid()->sum('bid_amount');
    }


    public function acceptedBid()
    {
        return $this->belongsTo(Bid::class, 'accepted_bid_id');
    }
}
