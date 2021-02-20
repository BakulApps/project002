<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slider_title' => $this->faker->sentence,
            'slider_content' => $this->faker->sentence(20),
            'slider_button_link_1' => route('potral.article.read', 1),
            'slider_button_name_1' => 'Selengkapnya',
            'slider_button_link_2' => '#',
            'slider_button_name_2' => 'Daftar Sekarang',
            'slider_image' => 'storage/portal/fronted/images/slider/s-1.jpg',
            'slider_status' => $this->faker->boolean
        ];
    }
}
