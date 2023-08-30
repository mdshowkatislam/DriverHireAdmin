<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDriverOnlineLogRequest;
use App\Http\Requests\DeleteDriverOnlineLogRequest;
use App\Http\Requests\UpdateDriverOnlineLogRequest;
use App\Models\DriverOnlineLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DriverOnlineLogController extends Controller
{
    public function index()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'driver_online_logs' => DriverOnlineLog::all()
            ]
        );
    }


    public function store(CreateDriverOnlineLogRequest $createDriverOnlineLogRequest)
    {
        $id = Auth::guard('api')->id();
        try {
            DriverOnlineLog::where('driver_id', $id)
                ->delete();

            // add id in request
            $createDriverOnlineLogRequest->replace(array_merge($createDriverOnlineLogRequest->all(), ['driver_id' => $id]));
            $createDriverOnlineLogRequest->replace(array_merge($createDriverOnlineLogRequest->all(), ['date_time' => Carbon::parse($createDriverOnlineLogRequest->input('date_time'))->format('Y-m-d H:i:s')]));

            $driverOnlineLog = DriverOnlineLog::create($createDriverOnlineLogRequest->all());

            return sendResponse(
                'Driver online log created successfully',
                [
                    'driver_online_log' => $driverOnlineLog
                ]
            );
        } catch (\Exception $exception) {
            return sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ]
            );
        }
    }


    public function userDriverOnlineLog()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'driver_online_log' => DriverOnlineLog::where('driver_id', Auth::guard('api')->id())->first()
            ]
        );
    }


    public function delete(DeleteDriverOnlineLogRequest $deleteDriverOnlineLogRequest)
    {
         DriverOnlineLog::where('id', $deleteDriverOnlineLogRequest->input('id'))->delete();

         return sendResponse('Driver online log deleted successfully');
    }


    public function update(UpdateDriverOnlineLogRequest $updateDriverOnlineLogRequest, $id)
    {
        if ( $updateDriverOnlineLogRequest->has('date_time') ){
            $updateDriverOnlineLogRequest->replace([
                'date_time' => Carbon::parse($updateDriverOnlineLogRequest->input('date_time'))->format('Y-m-d H:i:s')
            ]);
        }

        try {
            DriverOnlineLog::where('id', $id)->update($updateDriverOnlineLogRequest->all());

            return sendResponse(
                'Driver online log updated successfully',
                [
                    'driver_on;ine_log' => DriverOnlineLog::where('id', $id)->first()
                ]
            );
        } catch (\Exception $exception){
            return sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
