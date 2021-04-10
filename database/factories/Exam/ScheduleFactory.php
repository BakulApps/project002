<?php

namespace Database\Factories\Exam;

use App\Models\Exam\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'schedule_subject' => $this->faker->numberBetween(1, 17),
            'schedule_level' => $this->faker->numberBetween(1, 5),
            'schedule_start' => $this->faker->dateTime,
            'schedule_end' => $this->faker->dateTime,
            'schedule_token' => $this->faker->text(5),
            'schedule_link' => $this->faker->url,
            'schedule_monitoring' => $this->faker->url,

        ];
    }
}
