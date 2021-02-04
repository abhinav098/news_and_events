<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // App\Models\Article::factory(4)->create(['user_id' => 5]);
        return [
            'headline' => $this->faker->sentence,
            'body' => $this->faker->paragraph(),
            'publication_date' => $this->faker->dateTimeBetween('this week', '+6 days'),
            'user_id' => \App\Models\User::factory(),
            'image_path' => '16124174308ZPAFIekF8.jpg'
        ];
    }
}

