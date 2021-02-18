<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Event;
use Carbon\Carbon;
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
        return [
            'event_title' => $this->faker->sentence,
            'event_content' => $this->faker->sentence(80),
            'event_place' => $this->faker->city,
            'event_date_start' => Carbon::create(2021, 02, 11, 8, 0, 0),
            'event_date_end' => $this->faker->dateTime
        ];
    }
}
