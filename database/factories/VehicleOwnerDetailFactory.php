<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleOwnerDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'v_owner_id' => function(){
                return User::all()->random();
            },
            'present_address' => $this->faker->address(),
            'permanent_address' => $this->faker->address(),
            'dob' => $this->faker->date()
        ];
    }
}
