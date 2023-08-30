<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function allPhones()
    {
        return sendResponse(
            'Data fetched successfully',
            [
                'phones' => User::select('phone')->get()->pluck('phone')->toArray()
            ]
        );
    }


    public function getAllHireRequest()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'status' =>[
                    'pending'        => 'pending',
                    'accepted'       => 'accepted',
                    'ride_started'   => 'Ride Started',
                    'ride_completed' => 'Ride Completed',
                    'ride_cancel'    => 'Ride Cancel',
                    'unknown'        => 'Wnknown'
                ]
            ]
        );
    }
}
