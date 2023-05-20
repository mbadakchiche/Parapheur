<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;


class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name_ar' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'name_en' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'thumbnail' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'abr_latin' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'abr_ar' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
