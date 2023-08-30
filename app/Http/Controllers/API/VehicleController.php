<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleCreateRequest;
use App\Http\Requests\VehicleDeleteRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends Controller
{
    public function create(VehicleCreateRequest $vehicleCreateRequest)
    {
        $insertData = $this->processCreateData($vehicleCreateRequest);

        try {
            $vehicleData = Vehicle::create($insertData);

            return sendResponse(
                'Vehicle added successfully',
                [
                    'vehicle' => $vehicleData
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $exception){
            return sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ]
                ,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function update(VehicleUpdateRequest $vehicleUpdateRequest, $id)
    {
        try {
            Vehicle::where('id', $id)->update($this->processUpdateData($vehicleUpdateRequest));

            return sendResponse(
                'Vehicle information updated',
                [
                    'vehicle' => Vehicle::where('id', $id)->first()
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $exception){
            return sendError(
                'Something went wrong',
                [
                    'error' => 'Internal server erro'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function index()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'vehicles' => Vehicle::all()
            ]
        );
    }


    public function getUserVehicle()
    {
        $id = Auth::guard('api')->id();
        return sendResponse(
            'Data fetch successfully',
            [
                'vehicles' => Vehicle::where('user_id', $id)->get()
            ]
        );
    }


    public function delete(VehicleDeleteRequest $vehicleDeleteRequest)
    {
        Vehicle::where('id', $vehicleDeleteRequest->input('id'))->delete();

        return sendResponse(
            'Vehicle deleted successfully'
        );
    }


    private function processCreateData(FormRequest $formRequest){
        $insertData['user_id'] = $formRequest->input('user_id');
        $insertData['v_name'] = $formRequest->input('v_name');
        $insertData['v_year'] = $formRequest->input('v_year');
        $insertData['v_model'] = $formRequest->input('v_model');
        $insertData['v_chassis'] = $formRequest->input('v_chassis');
        $insertData['v_engine'] = $formRequest->input('v_engine');
        $insertData['v_number_plate'] = $formRequest->input('v_number_plate');
        $insertData['v_color'] = $formRequest->input('v_color');
        $insertData['status'] = $formRequest->input('status') ?? 0;
        $insertData['v_type'] = $formRequest->input('v_type');

        return array_merge($insertData, $this->checkForImages($formRequest));
    }


    private function processUpdateData(FormRequest $formRequest)
    {
        $insertData = [];

        if ( $formRequest->has('user_id') )
            $insertData['user_id'] = $formRequest->input('user_id');
        if ( $formRequest->has('v_name') )
            $insertData['v_name'] = $formRequest->input('v_name');

        if ( $formRequest->has('v-year') )
            $insertData['v_year'] = $formRequest->input('v_year');

        if ( $formRequest->has('v_model') )
            $insertData['v_model'] = $formRequest->input('v_model');

        if ( $formRequest->has('v_chassis') )
            $insertData['v_chassis'] = $formRequest->input('v_chassis');

        if ( $formRequest->has('v_engine') )
            $insertData['v_engine'] = $formRequest->input('v_engine');

        if ( $formRequest->has('v_number_plate') )
            $insertData['v_number_plate'] = $formRequest->input('v_number_plate');

        if ( $formRequest->has('v_color') )
            $insertData['v_color'] = $formRequest->input('v_color');

        if ( $formRequest->has('status') )
            $insertData['status'] = $formRequest->input('status');

        if ( $formRequest->has('v_type') )
            $insertData['v_type'] = $formRequest->input('v_type');

        return array_merge($insertData, $this->checkForImages($formRequest));
    }


    private function checkForImages(FormRequest $formRequest){
        $insertData = [];
        if ( $formRequest->hasFile('v_tax_token') ){
            $insertData['v_tax_token'] = uploadImage($formRequest->file('v_tax_token'), 'vehicle');
        }

        if ( $formRequest->hasFile('v_fitness_certificate') ){
            $insertData['v_fitness_certificate'] = uploadImage($formRequest->file('v_fitness_certificate'), 'vehicle');
        }

        if ( $formRequest->hasFile('v_tax_token') ){
            $insertData['v_root_permit'] = uploadImage($formRequest->file('v_root_permit'), 'vehicle');
        }

        if ( $formRequest->hasFile('v_insurance') ){
            $insertData['v_insurance'] = uploadImage($formRequest->file('v_insurance'), 'vehicle');
        }

        if ( $formRequest->hasFile('v_photo') ){
            $insertData['v_photo'] = uploadImage($formRequest->file('v_photo'), 'vehicle');
        }

        return $insertData;
    }
}