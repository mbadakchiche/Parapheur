<?php

namespace Database\Factories;

use App\Models\Register;
use Illuminate\Database\Eloquent\Factories\Factory;


class RegisterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Register::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'label_ar' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'label_en' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'year' => 2023,
            'service_id' => 1,
            'type'=>rand(1,2),
            'category'=>rand(1,2),
            'starting_nbr' => $this->faker->numberBetween(0, 999),
            'licence' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
