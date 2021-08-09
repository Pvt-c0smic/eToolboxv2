<?php

namespace Database\Factories;

use App\Models\Personnel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonnelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personnel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->text(255),
            'email' => $this->faker->text(255),
            'phone_number' => $this->faker->phoneNumber,
            'afpsn' => $this->faker->text(255),
            'address' => $this->faker->text,
            'designation' => $this->faker->text(255),
            'bos_id' => \App\Models\Bos::factory(),
            'rank_id' => \App\Models\Rank::factory(),
            'office_id' => \App\Models\Office::factory(),
        ];
    }
}
