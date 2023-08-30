<?php

use App\Models\HireRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if ( ! function_exists('sendResponse') ){
    /**
     * @param $message
     * @param array $result
     * @param int $code
     * @return JsonResponse
     */
    function sendResponse($message, array $result = [], int $code = 200) {
        $response = [
            'code'    => $code,
            'success' => true,
            'message' => $message,
            'data'    => $result,
            'errors'  => []
        ];

        return response()->json($response, $code);
    }
}


if( ! function_exists('sendError') ){
    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    function sendError($error, array $errorMessages = [], int $code = 404) {
        $response = [
            'code'    => $code,
            'success' => false,
            'message' => $error,
            'data'    => [],
            'errors'  => $errorMessages,
        ];

        return response()->json($response, $code);
    }
}



if ( ! function_exists('sendSMS')){
    /**
     * @param $phone
     * @param $message
     * @return bool|string
     */
    function sendSMS($phone, $message){
        $to = $phone;
        $key = env('SMS_API_KEY', 'C200952962a6e925931145.17618312');
        $url = "http://bangladeshsms.com/smsapi";
        $data = [
            "api_key" => $key,
            "type" => "text",
            "contacts" => $to,
            "senderid" => "CSBEDU",
            "msg" => $message,
          ];
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $response = curl_exec($ch);
          curl_close($ch);
          return $response; // Close cURL
    }
}


if ( ! function_exists('roleIdByRoleName') ){
    /**
     * @param $name
     */
    function roleIdByRoleName($name){
        return DB::table('roles')->where('name', 'LIKE', '%'.$name.'%')->select('id')->first()->id ?? null;
    }
}


if ( ! function_exists('uploadImage') ) {
    /**
     * @param UploadedFile $uploadedFile
     * @param $folder
     * @param $disk
     * @param $filename
     * @return false|string
     */
    function uploadImage(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {

        $name = !is_null($filename) ? $filename : Str::random(25) . '_' . time();

        searchFolderOrCreate($folder, $disk);

        return $uploadedFile->storeAs($folder, $name . '.' . $uploadedFile->getClientOriginalExtension(), $disk);
    }
}


if ( ! function_exists('searchFolderOrCreate') ){
    /**
     * @param $path
     * @param $disk
     * @return void
     */
    function searchFolderOrCreate($path, $disk) {
        if (!Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->makeDirectory($path);
            artisanCall('storage:link');
        }
    }
}


if ( ! function_exists('artisanCall') ){
    /**
     * @param $command
     * @param $parameters
     * @return void
     */
    function artisanCall($command, $parameters = []) {
        Artisan::call($command, $parameters);
    }
}


if ( ! function_exists('creatreOtp') ){
    /**
     * @param $digits
     * @return int
     */
    function creatreOtp($digits){
        return rand(pow(10, $digits-1), pow(10, $digits));
    }
}


if ( ! function_exists('storeOTP') ){
    /**
     * @param $data
     * @return bool
     */
    function storeOTP($data){
        return DB::table('otps')->insert($data);
    }
}


if ( ! function_exists('storePassResetOTP') ){
    function storePassResetOTP($data){
        DB::table('password_resets')->insert($data);
    }
}


if ( ! function_exists('formatDate') ){
    /**
     * @param $data
     * @param $format
     * @return string
     */
    function formatDate($data, $format = 'F j, Y, g:i a'){
        return \Illuminate\Support\Carbon::parse($data)->format($format);
    }
}


if ( ! function_exists('insertDriverDetails') ){
    /**
     * @param $userData
     * @param \Illuminate\Foundation\Http\FormRequest $formRequest
     * @return bool
     */
    function insertDriverDetails($userData, \Illuminate\Foundation\Http\FormRequest $formRequest){
        $insertData = [
            'driver_id' => $userData->id,
            'nid'       => uploadImage($formRequest->file('nid'), 'userImages'),
            'licence_no' => $formRequest->input('licence_no'),
            'licence_copy_front' => uploadImage($formRequest->file('licence_copy_front'), 'userImages'),
            'licence_copy_back' => uploadImage($formRequest->file('licence_copy_back'), 'userImages'),
            'status' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'updated_at' => \Illuminate\Support\Carbon::now(),
        ];

        return DB::table('driver_details')->insert(array_merge($insertData, userDetailsCommonPart($formRequest)));
    }
}


if ( ! function_exists('insertVehicleOwnerDetails') ){
    /**
     * @param $userData
     * @param \Illuminate\Foundation\Http\FormRequest $formRequest
     * @return bool
     */
    function insertVehicleOwnerDetails($userData, \Illuminate\Foundation\Http\FormRequest $formRequest){
        $insertData = [
            'v_owner_id' => $userData->id,
            'status' => 1,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'updated_at' => \Illuminate\Support\Carbon::now(),
        ];

        $insertData = array_merge($insertData, userDetailsCommonPart($formRequest));

        return DB::table('vehicle_owner_details')->insert($insertData);
    }
}


if ( ! function_exists('userDetailsCommonPart') ){
    function userDetailsCommonPart($request){
        return [
            'present_address' => $request->input('present_address'),
            'permanent_address' => $request->input('permanent_address'),
            'dob' => \Illuminate\Support\Carbon::parse($request->input('dob'))->format('Y-m-d'),
        ];
    }
}


if( ! function_exists('assetHelper') ){
    function assetHelper($path){
        return ( strpos($path, 'https') !== false ) ? $path :  asset('storage/'. $path);
    }
}


if( ! function_exists('roleNameById') ){
    function roleNameById($id){
        return DB::table('roles')->where('id', $id)->select('name')->first()->name ?? null;
    }
}



if( ! function_exists('totalIncome') ){
    function totalIncome($id){
        return \App\Models\HireRequest::with('acceptedBid')
            ->where('hire_status', 'ride_completed')
            ->where('bid_winner_id', $id)
            ->get()->sum('acceptedBid.bid_amount');
    }
}


if( ! function_exists('totalExpense') ){
    function totalExpense($id){
        return \App\Models\HireRequest::with('acceptedBid')
            ->where('hire_status', 'ride_completed')
            ->where('v_owner_id', $id)
            ->get()->sum('acceptedBid.bid_amount');
    }
}


if ( ! function_exists('dashboardSummery') ){
    function dashboardSummery(){
        $driver = roleIdByRoleName('driver');
        return [
            'total_users'        => User::where('status', 1)->count(),
            'total_drivers'      => User::where('status', 1)->where('role_id', $driver)->count(),
            'total_owners'       => User::where('status', 1)->where('role_id', '!=', $driver)->count(),
            'total_hire_request' => HireRequest::all()->count(),
        ];
    }
}


if ( ! function_exists('getAllRouteNames') ){
    function getAllRouteNames(){
        $routeCollection = Route::getRoutes();
        $routes = [];
        foreach ($routeCollection as $route) {
            $routes[] = $route->getName();
        }
        return $routes;
    }
}



if ( ! function_exists('checkCurrentRouteNameExist') ){
    function checkCurrentRouteNameExist($routes){
        return in_array(Route::currentRouteName(), $routes);
    }
}


if ( ! function_exists('searchForm') ){
    function searchForm($route){
        return view('layouts.searchForm', compact('route'));
    }
}


if( ! function_exists('notificationFactory') ){
    function notificationFactory(){

        $insertData = [];

        for ($i = 0; $i <= 49; $i++){
            $insertData[] = [
                'id' => \Illuminate\Support\Str::uuid(),
                'type' => 'App\Notifications\GroupInviteNotification',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => 1,
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'data' => json_encode([
                    'group_id' => 1,
                    'group_name' => 'Group 1',
                    'invited_by' => 1,
                    'invited_by_name' => 'Admin',
                ]),
            ];
        }

        DB::table('notifications')->insert($insertData);
    }
}


if( ! function_exists('subString') ){
    function subString($string, $char ){
        $explode = explode($char, $string);
        return $explode[count($explode) - 1];
    }
}


if ( ! function_exists('stringToJson') ){
    function stringToJson($string){
        return json_decode($string, true);
    }
}


if( ! function_exists('arrayToTable')){
    function arrayToTable($array){
        $html = '<table class="table table-bordered">';
        foreach ($array as $key => $value){
            $html .= '<tr>';
            $html .= '<td>'. $key .'</td>';
            $html .= '<td>'. $value .'</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }
}


if ( ! function_exists('isRead') ){
    function isRead($notification){
        return $notification->read_at ? '<span class="badge bg-primary">Read</span>' : '<span class="badge bg-warning">Unread</span>';
    }
}


if ( ! function_exists('userFullName') ){
    function userFullName($user){
        return $user->first_name .' '. $user->last_name;
    }
}


if ( ! function_exists('driverOnlineOfflineStatusBadge') ){
    function driverOnlineOfflineStatusBadge($status){
        return ($status == 'online') ? '<span class="badge bg-success">Online</span>' : '<span class="badge bg-danger">Offline</span>';
    }
}



if ( ! function_exists('renderPagination') ){
    function renderPagination($pagination){
        if( $pagination->hasPages() ){
            echo $pagination->onEachSide(2)->links();
        }

        if( $pagination->hasPages() ) {
            echo '<div class="pagination text-center">';
            echo 'Showing ' . $pagination->firstItem() . ' to ' . $pagination->lastItem() . ' of ' . $pagination->total() . ' entries';
            echo '</div>';
        }
    }
}


if ( ! function_exists('roleFactory') ){
    function roleFactory()
    {
        $roles = [
            [
                'name' => 'driver',
                'status' => 1,
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
            ],
            [
                'name' => 'owner',
                'status' => 1,
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}


if ( ! function_exists('updateHireRequestFactory') ){
    function updateHireRequestFactory(){
        $hireRequests = \App\Models\HireRequest::all();
        foreach ($hireRequests as $hireRequest){
            if ($hireRequest->bid_winner_id){
                $hireRequest->update([
                    'accepted_bid_id' => \App\Models\Bid::all()->random()->id,
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                ]);
            }
        }
    }
}
