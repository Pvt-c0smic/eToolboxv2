<?php

namespace Database\Factories;

use App\Models\Bos;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text(255),
            'description' => $this->faker->text(255),
        ];
    }
}
