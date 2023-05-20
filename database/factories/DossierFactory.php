<?php

namespace Database\Factories;

use App\Models\Dossier;
use Illuminate\Database\Eloquent\Factories\Factory;


class DossierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dossier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'label_ar' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'label_en' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'user_id' => $this->faker->numberBetween(0, 999),
            'status' => $this->faker->numberBetween(0, 999),
            'description' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
