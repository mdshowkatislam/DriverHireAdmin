<?php

use App\Http\Controllers\DriverOnlineLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationTemplateController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleOwnerDetailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HireRequestController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\LocationController;

Auth::routes();

// all artisan call
Route::get('/artisan', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('migrate');
    // storage link
    Artisan::call('storage:link');
    return 'DONE'; //Return anything
});

Route::get('dashboardChart', [HomeController::class, 'chartAJAXRequest'])->name(
    'dashboardChart'
);

Route::middleware('auth:web')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Add User
    Route::get('/add/user', [UserController::class, 'create'])->name(
        'add.user'
    );
    Route::post('/store/user', [UserController::class, 'store'])->name(
        'store.user'
    );

    //Driver
    Route::prefix('driver')->group(function () {
        Route::get('/', [DriverDetailController::class, 'index'])->name(
            'driver'
        );
        Route::get('/show/{id}', [DriverDetailController::class, 'show'])->name(
            'driver.show'
        );
        Route::get('/edit/{id}', [DriverDetailController::class, 'edit'])->name(
            'driver.edit'
        );
        Route::post('/update/{id}', [
            DriverDetailController::class,
            'update',
        ])->name('driver.update');
        Route::get('/delete/{id}', [
            DriverDetailController::class,
            'destroy',
        ])->name('driver.delete');
    });
    Route::get('change/status/{id}', [
        DriverDetailController::class,
        'changeDriverStatus',
    ])->name('change.status');

    //Hire Request
    Route::get('/hire/request', [HireRequestController::class, 'index'])->name(
        'hire.request'
    );
    Route::get('/hire/request/show/{id}', [
        HireRequestController::class,
        'show',
    ])->name('hire.show');

    //Location
    Route::get('driver/location', [LocationController::class, 'index'])->name(
        'driver.location'
    );

    //Vehicle Owner
    Route::prefix('owners')->group(function () {
        Route::get('/', [VehicleOwnerDetailController::class, 'index'])->name(
            'owner'
        );
        Route::get('/show/{id}', [
            VehicleOwnerDetailController::class,
            'show',
        ])->name('owner.show');
        Route::get('/edit/{id}', [
            VehicleOwnerDetailController::class,
            'edit',
        ])->name('owner.edit');
        Route::post('/update/{id}', [
            VehicleOwnerDetailController::class,
            'update',
        ])->name('owner.update');
        Route::get('/delete/{id}', [
            VehicleOwnerDetailController::class,
            'destroy',
        ])->name('owner.delete');
    });

    //Admin User
    Route::prefix('admin')->group(function () {
        Route::get('/user', [AdminController::class, 'index'])->name(
            'admin.user'
        );
        Route::get('/show/{id}', [AdminController::class, 'show'])->name(
            'admin.show'
        );
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name(
            'admin.edit'
        );
        Route::post('/update/{id}', [AdminController::class, 'update'])->name(
            'admin.update'
        );
        Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name(
            'admin.delete'
        );
        Route::get('/add', [AdminController::class, 'addAdmin'])->name(
            'add.admin'
        );
        Route::post('/store', [AdminController::class, 'storeAdmin'])->name(
            'admin.store'
        );
    });

    //Vehicle
    Route::prefix('vehicle')->group(function () {
        Route::get('/', [VehicleController::class, 'index'])->name('vehicles');
        Route::get('/show/{id}', [VehicleController::class, 'show'])->name(
            'vehicle.show'
        );
        Route::get('/edit/{id}', [VehicleController::class, 'edit'])->name(
            'vehicle.edit'
        );
        Route::post('/update/{id}', [VehicleController::class, 'update'])->name(
            'vehicle.update'
        );
        Route::get('/delete/{id}', [VehicleController::class, 'destroy'])->name(
            'vehicle.delete'
        );
        Route::get('/add', [VehicleController::class, 'create'])->name(
            'add.vehicle'
        );
        Route::post('/store', [VehicleController::class, 'store'])->name(
            'store.vehicle'
        );
    });

    Route::prefix('notification')->group(function () {
        Route::get('/', [NotificationTemplateController::class, 'index'])->name(
            'notification.index'
        );
        Route::get('/list', [
            NotificationTemplateController::class,
            'list',
        ])->name('notification.list');
        Route::post('/', [
            NotificationTemplateController::class,
            'store',
        ])->name('notification.store');
        Route::get('/{id}', [
            NotificationTemplateController::class,
            'edit',
        ])->name('notification.edit');
        Route::post('/{id}', [
            NotificationTemplateController::class,
            'update',
        ])->name('notification.update');
        Route::get('/delete/{id}', [
            NotificationTemplateController::class,
            'destroy',
        ])->name('notification.delete');
        Route::get('/list/delete/{id}', [
            NotificationTemplateController::class,
            'listDelete',
        ])->name('notification.list.delete');
    });

    // driver online offline log
    Route::prefix('driver/log')
        ->as('driver.log.')
        ->group(function () {
            Route::get('/', [DriverOnlineLogController::class, 'index'])->name(
                'index'
            );
        });

    // Status switch
    Route::post('/admin/change/{id}', [
        UserController::class,
        'changeDriverStatus',
    ])->name('change.all.status');
});
