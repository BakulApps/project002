<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'program_name' => $this->faker->sentence(1),
            'program_desc' => $this->faker->sentence(1),
            'program_link' => route('potral.home'),
            'program_image' => 'assets/portal/fronted/images/icon/quran.png'
        ];
    }
}
