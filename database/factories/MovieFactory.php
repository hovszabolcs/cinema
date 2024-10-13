<?php

namespace Database\Factories;

use App\Enums\AgeClassification;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition(): array
    {
        return [
            'title' => fake()->text(50),
            'description' => fake()->sentence(200),
            'age_classification' => array_rand(array_flip(AgeClassification::toArray())),
            'lang' => array_rand(array_flip(['magyar', 'német', 'angol'])),
            'image_path' => 'https://random.imagecdn.app/300/450',
        ];
    }
}
