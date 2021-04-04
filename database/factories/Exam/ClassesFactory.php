<?php

namespace Database\Factories\Exam;

use App\Models\Exam\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'class_level' => $this->faker->numberBetween(1, 10),
            'class_major' => $this->faker->numberBetween(1, 10),
            'class_code' => $this->faker->numberBetween(100, 999),
            'class_name' => $this->faker->text(5)
        ];
    }
}
