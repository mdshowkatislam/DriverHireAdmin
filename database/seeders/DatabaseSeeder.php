<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Bid;
use App\Models\DriverDetail;
use App\Models\DriverOnlineLog;
use App\Models\HireRequest;
use App\Models\Location;
use App\Models\NotificationTemplate;
use App\Models\Review;
use App\Models\User;
use App\Models\VehicleOwnerDetail;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        roleFactory();
        Admin::factory(3)->create();
        User::factory(10)->create();
        Vehicle::factory(30)->create();

        DriverDetail::factory(10)->create();
        VehicleOwnerDetail::factory(10)->create();

        HireRequest::factory(50)->create();
        Bid::factory(100)->create();

        Location::factory(200)->create();

        NotificationTemplate::factory(10)->create();

        Review::factory(200)->create();


        notificationFactory();

        DriverOnlineLog::factory(50)->create();

        updateHireRequestFactory();
    }
}
