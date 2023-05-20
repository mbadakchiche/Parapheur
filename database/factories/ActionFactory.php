<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Database\Eloquent\Factories\Factory;


class ActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Action::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name_ar' => $this->faker->text($this->faker->numberBetween(5, 30)),
            'name_en' => $this->faker->text($this->faker->numberBetween(5, 30)),

            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
