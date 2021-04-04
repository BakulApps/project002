<?php

namespace Database\Factories\Exam;

use App\Models\Exam\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_name' => $this->faker->name,
            'student_number' => $this->faker->text(14),
            'student_class' => $this->faker->numberBetween(1, 10),
            'student_username' => $this->faker->text(10),
            'student_password' => $this->faker->text(5)
        ];
    }
}
