<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PersonnelType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonnelTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonnelType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(255),
        ];
    }
}
