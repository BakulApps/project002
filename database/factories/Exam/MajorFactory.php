<?php

namespace Database\Factories\Exam;

use App\Models\Exam\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

class MajorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Major::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'major_code' => $this->faker->numberBetween(100, 999),
            'major_name' => $this->faker->text(5)
        ];
    }
}
