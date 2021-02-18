<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Extracurricular;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtracurricularFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Extracurricular::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'extracurricular_name' => $this->faker->sentence(1),
            'extracurricular_desc' => $this->faker->sentence(10),
            'extracurricular_image' => 'storage/portal/fronted/images/extracurricular/cu-1.jpg'
        ];
    }
}
