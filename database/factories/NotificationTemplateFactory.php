<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'template_subject' => $this->faker->sentence(7),
            'template_body' => $this->faker->paragraph(5),
        ];
    }
}
