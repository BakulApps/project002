<?php

namespace Database\Factories\Exam;

use App\Models\Exam\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Level::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'level_name' => $this->faker->numberBetween(1, 10)
        ];
    }
}
