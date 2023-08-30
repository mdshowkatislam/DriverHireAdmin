<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteHireRequestRequest;
use App\Http\Requests\HireRequestRequest;
use App\Http\Requests\UpdateHireRequestRequest;
use App\Models\HireRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HireRequestController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api')->user();

        if ( $user->role->name == 'driver' ){
            // check if started hire request exists
            $hireRequest = HireRequest::where('bid_winner_id', $user->id)
                ->where('hire_status', 'ride_started')
                ->orderBy('id', 'DESC')
                ->first();

            if ($hireRequest){
                return sendResponse(
                    'Hire request fetch successfully',
                    [
                        'hire_request' => []
                    ],
                    Response::HTTP_OK
                );
            }

            return sendResponse(
                'Data fetch successfully',
                [
                    'hire_requests' => HireRequest::with([
                        'vehicleOwner', 'vehicle', 'bidWinner', 'acceptedBid'
                    ])->where('v_owner_id', '!=', $user->id)->get()
                ]
            );
        } else {
            return sendResponse(
                'Data fetch successfully',
                [
                    'hire_requests' => HireRequest::with([
                        'vehicleOwner', 'vehicle', 'bidWinner', 'acceptedBid'
                    ])->where('v_owner_id', $user->id)->get()
                ]
            );
        }

    }


    public function userHireRequest()
    {
        $id = Auth::guard('api')->id();

        return sendResponse(
            'Data fetch successfully',
            [
                'hire_requests' => HireRequest::with([
                    'vehicleOwner', 'vehicle', 'bidWinner', 'acceptedBid'
                ])->where('v_owner_id', $id)
                    ->where('hire_status', '!=', 'ride_completed')
                    ->where('hire_status', '!=', 'ride_cancel')
                    ->orderBy('created_at', 'DESC')->get()
            ]
        );
    }

    public function store(HireRequestRequest $hireRequestRequest)
    {
        $id = Auth::guard('api')->id();

        // cheek if hire request already exists
        $hireRequest = HireRequest::where('v_owner_id', $id)
            ->where('hire_status', 'ride_completed')
            ->orWhere('hire_status', 'ride_cancel')
            ->orWhere('hire_status', 'unknown')
            ->orderBy('id', 'DESC')
            ->first();

        if (!$hireRequest){
            return sendResponse(
                'You already have a hire request',
                [],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $hireRequestRequest->merge([
                'v_owner_id' => $id,
                'hire_id'    => 'H' . Carbon::now()->timestamp,
            ]);

            $hireRequest = HireRequest::create($hireRequestRequest->all());

            return sendResponse(
                'Hire request created successfully',
                [
                    'hireRequest' => $hireRequest
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $exception){
            return sendResponse(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function update(UpdateHireRequestRequest $updateHireRequestRequest, $id)
    {
        try {
            HireRequest::where('id', $id)->update(
                $this->processHireRequestUpdateData($updateHireRequestRequest)
            );

            return sendResponse(
                'Hire request updated successfully',
                [
                    'hire_request' => HireRequest::where('id', $id)->first()
                ]
            );
        } catch (\Exception $exception){
            return  sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function delete(DeleteHireRequestRequest $deleteHireRequestRequest)
    {
        HireRequest::where('id', $deleteHireRequestRequest->input('id'))->delete();

        return sendResponse('Hire request deleted successfully');
    }


    private function processHireRequestUpdateData(FormRequest $formRequest){
        $updateData = [];

        if ( $formRequest->has('bid_winner_id') )
            $updateData['bid_winner_id'] = $formRequest->input('bid_winner_id');

        if ( $formRequest->has('accepted_bid_id') )
            $updateData['accepted_bid_id'] = $formRequest->input('accepted_bid_id');

        if ( $formRequest->has('v_id') )
            $updateData['v_id'] = $formRequest->input('v_id');

        if ( $formRequest->has('from_location') )
            $updateData['from_location'] = $formRequest->input('from_location');

        if ( $formRequest->has('to_location') )
            $updateData['to_location'] = $formRequest->input('to_location');

        if ( $formRequest->has('return_location') )
            $updateData['return_location'] = $formRequest->input('return_location');

        if ( $formRequest->has('note') )
            $updateData['note'] = $formRequest->input('note');

        if ( $formRequest->has('hire_status') )
            $updateData['hire_status'] = $formRequest->input('hire_status');

        if ( $formRequest->has('from_location_lat') )
            $updateData['from_location_lat'] = $formRequest->input('from_location_lat');

        if ( $formRequest->has('from_location_long') )
            $updateData['from_location_long'] = $formRequest->input('from_location_long');

        if ( $formRequest->has('to_location_lat') )
            $updateData['to_location_lat'] = $formRequest->input('to_location_lat');

        if ( $formRequest->has('to_location_long') )
            $updateData['to_location_long'] = $formRequest->input('to_location_long');

        if ( $formRequest->has('return_location_lat') )
            $updateData['return_location_lat'] = $formRequest->input('return_location_lat');

        if ( $formRequest->has('return_location_long') )
            $updateData['return_location_long'] = $formRequest->input('return_location_long');

        if ( $formRequest->has('trip_date_time') )
            $updateData['trip_date_time'] = Carbon::parse($formRequest->input('trip_date_time'))->format('Y-m-d H:i:s') ;

        if ( $formRequest->has('trip_end_date_time') )
            $updateData['trip_end_date_time'] = Carbon::parse($formRequest->input('trip_end_date_time'))->format('Y-m-d H:i:s') ;

        return $updateData;
    }
}
