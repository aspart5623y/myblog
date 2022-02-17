<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    
        return [
            'title' => $this->faker->unique()->words($nb=10,$asText=true),
            'body' => $this->faker->text(700),
            'image' => 'post_' . $this->faker->numberBetween(1,20) . '.jpg',
            'user_id' => $this->faker->numberBetween(1, 5),
            'category_id' => $this->faker->numberBetween(1, 5),
            'status' => 'approved',
            'created_at' => now(),
        ];
    }
}
