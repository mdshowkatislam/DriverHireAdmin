<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function (){
                $driver = roleIdByRoleName('driver');
                return User::where('id', $driver)->get()->random();
            },
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->latitude(),
        ];
    }
}
