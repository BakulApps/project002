<?php

namespace Database\Factories\Portal;

use App\Models\Portal\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Facility::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facility_name' => $this->faker->sentence(2),
            'facility_desc' => $this->faker->sentence(5),
            'facility_image' => 'storage/portal/fronted/images/facility/p-1.jpg'
        ];
    }
}
