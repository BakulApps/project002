<?php

namespace Database\Factories\Graduate;

use App\Models\Graduate\User;
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
            'user_name' => $this->faker->userName,
            'user_pass' => Hash::make('password'),
            'user_fullname' => $this->faker->name,
        ];
    }
}
