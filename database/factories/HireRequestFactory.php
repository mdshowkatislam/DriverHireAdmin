<?php

namespace Database\Factories;

use App\Models\Bid;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class HireRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bidId = $this->faker->randomElements([null, User::where('role_id', 1)->get()->random()->id]);

        $acceptedBidId = null;

        if ( $bidId[0] != null && Bid::all()->count() > 0 ) {
            $acceptedBidId = Bid::all()->random()->id;
        }

        return [
            'hire_id' => $this->faker->uuid,
            'v_owner_id' => function (){
                return User::where('role_id', '!=', 1)->get()->random();
            },
            'v_id' => function(){
                return Vehicle::all()->random();
            },
            'bid_winner_id' => $bidId[0],
            'accepted_bid_id' => $acceptedBidId,

            'from_location' => $this->faker->latitude(),
            'from_location_lat' => $this->faker->latitude(),
            'from_location_long' => $this->faker->latitude(),

            'to_location' => $this->faker->latitude(),
            'to_location_lat' => $this->faker->latitude(),
            'to_location_long' => $this->faker->latitude(),

            'return_location' => $this->faker->locale(),
            'return_location_lat' => $this->faker->locale(),
            'return_location_long' => $this->faker->locale(),

            'note' => $this->faker->text(20),
            'hire_status' => $this->faker->randomElement(['pending', 'accepted', 'ride_started', 'ride_completed', 'ride_cancel', 'unknown']),
            'status' => $this->faker->boolean(70),
            'trip_date_time' => $this->faker->dateTime(),
            'trip_end_date_time' => $this->faker->dateTime(),
        ];
    }
}
