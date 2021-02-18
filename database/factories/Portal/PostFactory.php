<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_image'    => 'storage/portal/fronted/images/extracurricular/cu-1.jpg',
            'post_author'   => $this->faker->numberBetween(1, 2),
            'post_category' => $this->faker->numberBetween(1, 3),
            'post_title'    => $this->faker->sentence,
            'post_content'  => $this->faker->paragraph(50),
            'post_comment'  => $this->faker->boolean,
            'post_status'   => $this->faker->boolean,
            'post_read'     => $this->faker->numberBetween(1, 900)

        ];
    }
}
