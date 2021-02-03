<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // App\Models\Article::factory(4)->create(['user_id' => 5]);

        $startingDate = $this->faker->dateTimeBetween('this week', '+6 days');
        // Random datetime of the current week *after* `$startingDate`
        $endingDate = $this->faker->dateTimeBetween($startingDate, strtotime('+6 days'));
        return [
            'start_date'=>$startingDate,
            'end_date'=>$endingDate,
            'location' => $this->faker->city(),
            'time' => $this->faker->time(),
            'description' => $this->faker->paragraph(),
            'title' => $this->faker->sentence(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
