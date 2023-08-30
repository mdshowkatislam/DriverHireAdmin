<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverOnlineLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'driver_id' => function (){
                $driver = roleIdByRoleName('driver');
                return User::where('role_id', $driver)->get()->random();
            },
            'status' => $this->faker->randomElement(['online', 'offline']),
            'date_time' => $this->faker->dateTime()
        ];
    }
}
