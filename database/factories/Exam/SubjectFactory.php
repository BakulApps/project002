<?php

namespace Database\Factories\Exam;

use App\Models\Exam\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_code' => $this->faker->numberBetween(100, 999),
            'subject_name' => $this->faker->colorName
        ];
    }
}
