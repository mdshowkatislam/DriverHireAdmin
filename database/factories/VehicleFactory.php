<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::all()->random();
            },
            'v_name' => $this->faker->name(),
            'v_type' => $this->faker->randomElement([
                'bus',
                'truck',
                'car',
                'pickup'
            ]),
            'v_year' => $this->faker->date(),
            'v_model' => Str::random(5),
            'v_chassis' => $this->faker->text(10),
            'v_engine' => $this->faker->text(10),
            'v_tax_token' => $this->faker->text(10),
            'v_fitness_certificate' => $this->faker->text(10),
            'v_root_permit' => $this->faker->imageUrl(),
            'v_number_plate' => $this->faker->text(10),
            'v_insurance' => $this->faker->text(10),
            'v_color' => $this->faker->colorName(),
            'v_photo' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([1, 0]),
        ];
    }
}
