<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'testimonial_name' => $this->faker->name,
            'testimonial_job' => $this->faker->jobTitle,
            'testimonial_desc' => $this->faker->sentence(30),
            'testimonial_image' => 'storage/portal/fronted/images/testimonial/t-1.jpg'
        ];
    }
}
