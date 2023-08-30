<?php

namespace Database\Factories;

use App\Models\HireRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bid_id' => $this->faker->uuid,
            'hire_request_id' => function (){
                return HireRequest::all()->random();
            },
            'driver_id' => function(){
                return User::all()->random();
            },
            'bid_amount' => $this->faker->randomFloat(2, 100, 10000),
            'note' => $this->faker->text(30),
            'status' => $this->faker->randomElement([true, false])
        ];
    }
}
