<?php

namespace Database\Factories;

use App\Models\Mail;
use Illuminate\Database\Eloquent\Factories\Factory;


class MailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'objet' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'ref' => $this->faker->text($this->faker->numberBetween(5, 10)),
            'body' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'service_id'=> rand(1,5),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
