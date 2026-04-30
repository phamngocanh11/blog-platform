<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'post_name' => $this->faker->sentence(6, true),
            'post_content' => $this->faker->paragraphs(3, true),
            'tags' => implode(',', $this->faker->words(3)),
            'likes' => $this->faker->numberBetween(0, 100),
            'comments' => $this->faker->numberBetween(0, 50),
            'views' => $this->faker->numberBetween(0, 500),
            'category_id' => Category::factory(),
            'series_id' => Series::factory(),
            'hidden' => $this->faker->boolean(20), // 20% chance of being hidden
            'thumbnail' => $this->faker->imageUrl(640, 480, 'cats', true),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
