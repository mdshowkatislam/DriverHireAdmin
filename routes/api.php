<?php

use App\Http\Controllers\API\Auth\AdminAuthController;
use App\Http\Controllers\API\BidController;
use App\Http\Controllers\API\DriverOnlineLogController;
use App\Http\Controllers\API\GeneralController;
use App\Http\Controllers\API\HireRequestController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return sendResponse(
        'Data fetch successfully',
        [
            'user' => \Illuminate\Support\Facades\Auth::guard('api')->user()
        ]
    );
});

Route::post('user', [AdminAuthController::class, 'updateProfile']);

Route::get('phones', [GeneralController::class, 'allPhones']);
Route::get('hire/request/status/all', [GeneralController::class, 'getAllHireRequest']);



Route::prefix('auth')->group(function (){
    Route::post('login', [AdminAuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AdminAuthController::class, 'logout'])->middleware('auth:api');
    Route::post('refresh', [AdminAuthController::class, 'refresh']);
    Route::post('signup', [AdminAuthController::class, 'register'])->name('auth.register');
    Route::post('verify', [AdminAuthController::class, 'validateUser'])->name('auth.verify');
    Route::post('resend', [AdminAuthController::class, 'resend'])->name('auth.resend');

    Route::post('password/reset', [AdminAuthController::class, 'resetPassword'])->name('auth.reset');
    Route::post('password/forget/request', [AdminAuthController::class, 'forgetPassRequest'])->name('auth.verifyPassword');
});


Route::middleware('auth:api')->group(function (){
    Route::prefix('location')->group(function (){
        Route::delete('/', [LocationController::class, 'deleteLocation']);
        Route::get('all', [LocationController::class, 'index']);
        Route::get('/user', [LocationController::class, 'userLocation']);
        Route::post('create', [LocationController::class, 'create']);
    });

    Route::prefix('vehicle')->group(function (){
        Route::get('/', [VehicleController::class, 'index']);
        Route::post('/', [VehicleController::class, 'create']);
        Route::post('/{id}', [VehicleController::class, 'update']);
        Route::delete('/', [VehicleController::class, 'delete']);
        Route::get('/user', [VehicleController::class, 'getUserVehicle']);
    });


    Route::prefix('hire/request')->group(function () {
        Route::post('/', [HireRequestController::class, 'store']);
        Route::post('/{id}', [HireRequestController::class, 'update']);
        Route::get('/', [HireRequestController::class, 'index']);
        Route::get('/user', [HireRequestController::class, 'userHireRequest']);
        Route::delete('/', [HireRequestController::class, 'delete']);
    });

    Route::prefix('bid')->group(function (){
        Route::post('/', [BidController::class, 'store']);
        Route::get('/', [BidController::class, 'index']);
        Route::get('/user', [BidController::class, 'userBid']);
        Route::delete('/', [BidController::class, 'delete']);
        Route::get('/{id}', [BidController::class, 'show']);
        Route::post('/{id}', [BidController::class, 'update']);
        Route::get('/by/hire/request/{hireRequestId}', [BidController::class, 'bidsByHireRequest']);
    });

    Route::prefix('review')->group(function (){
        Route::post('/', [ReviewController::class, 'store']);
        Route::get('/', [ReviewController::class, 'index']);
        Route::get('/user', [ReviewController::class, 'userReview']);
        Route::delete('/', [ReviewController::class, 'delete']);
        Route::get('/{id}', [ReviewController::class, 'show']);
        Route::post('/{id}', [ReviewController::class, 'update']);
    });

    Route::prefix('driver/online/log')->group(function (){
        Route::post('/', [DriverOnlineLogController::class, 'store']);
        Route::get('/', [DriverOnlineLogController::class, 'index']);
        Route::get('/user', [DriverOnlineLogController::class, 'userDriverOnlineLog']);
        Route::delete('/', [DriverOnlineLogController::class, 'delete']);
        Route::get('/{id}', [DriverOnlineLogController::class, 'show']);
        Route::post('/{id}', [DriverOnlineLogController::class, 'update']);
    });
});
