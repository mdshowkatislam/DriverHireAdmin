<?php

namespace Database\Factories;

use App\Models\HireRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hire_request_id' => function (){
                return HireRequest::all()->random();
            },
            'rate_by' => function (){
                return User::all()->random();
            },
            'rate_to' => function (){
                return User::all()->random();
            },
            'review_text' => $this->faker->text(15),
            'rating' => $this->faker->numberBetween(1, 5)
        ];
    }
}
