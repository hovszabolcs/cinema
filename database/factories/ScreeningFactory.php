<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Screening>
 */
class ScreeningFactory extends Factory
{
    protected $model = Screening::class;

    public function definition(): array
    {
        return [
            'start' => $this->faker->dateTimeBetween('now', '+1 year'),
            'seats_available' => $this->faker->numberBetween(0, 100),
            'url' => $this->faker->url(),
            'movie_id' => Movie::factory(),
        ];
    }
}
