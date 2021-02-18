<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_name' => $this->faker->lastName,
            'comment_email' => $this->faker->email,
            'comment_content'  => $this->faker->paragraph(8),
            'comment_read'      => $this->faker->boolean
        ];
    }
}
