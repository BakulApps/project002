<?php

namespace Database\Factories\Portal;

use App\Models\Portal\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_image'        => null,
            'user_fullname'     => $this->faker->name,
            'user_name'         => $this->faker->userName,
            'user_pass'         => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'user_email'        => $this->faker->email,
            'user_desc'         => $this->faker->paragraph,
            'user_role'         => $this->faker->numberBetween(1, 2),
            'user_facebook'     => $this->faker->userName,
            'user_instagram'    => $this->faker->userName,
            'user_twitter'      => $this->faker->userName
        ];
    }
}
