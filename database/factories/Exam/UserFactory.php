<?php

namespace Database\Factories\Exam;

use App\Models\Exam\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_image' => $this->faker->imageUrl(60,60),
            'user_fullname' => $this->faker->name,
            'user_name' => $this->faker->userName,
            'user_pass' => Hash::make('password'),
            'user_email' => $this->faker->email,
            'user_role' => $this->faker->numberBetween(1, 2),
            'user_desc' => $this->faker->sentence(6),

        ];
    }
}
