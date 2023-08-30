<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DriverDetailFactory extends Factory
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
                return User::all()->random();
            },
            'nid' => Str::random(15),
            'licence_no' => Str::random(15),
            'licence_copy_front' => $this->faker->imageUrl(),
            'licence_copy_back' => $this->faker->imageUrl(),
            'present_address' => $this->faker->address(),
            'permanent_address' => $this->faker->address(),
            'dob' => $this->faker->date()
        ];
    }
}
