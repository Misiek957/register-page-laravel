<?php

namespace Database\Factories;

use app\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'title' => $this->faker->sentence(3),
            'excerpt' => $this->faker->sentence(10),
            'body' =>  $this->faker->sentence(100),
        ];
    }
}
