<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\DeleteLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    public function index()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'locations' => Location::all()
            ]
        );
    }


    public function create(CreateLocationRequest $createLocationRequest)
    {
        $insertData = $createLocationRequest->only('lat', 'lng');

        $insertData = array_merge($insertData, ['user_id' => Auth::guard('api')->id()]);

        try {
            $location = Location::create($insertData);

            return sendResponse(
                'Location created successfully',
                [
                    'location' => $location
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $exception){
            return sendError(
                'Something went wrong',
                [
                    'error' => 'Internal server error '
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function userLocation()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'locations' => Location::where('user_id', Auth::guard('api')->id())->get()
            ]
        );
    }


    public function deleteLocation(DeleteLocationRequest $deleteLocationRequest)
    {
        Location::where('id',$deleteLocationRequest->input('location_id'))->delete();
        return sendResponse(
            'Location deleted successfully',
        );
    }
}
