<?php

namespace Database\Factories;

use App\Models\Parafeure;
use Illuminate\Database\Eloquent\Factories\Factory;


class ParafeureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parafeure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'service_id' => $this->faker->numberBetween(0, 999),
            'title' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'abstract' => $this->faker->text(500),
            'signed' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
