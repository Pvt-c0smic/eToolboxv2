<?php

namespace Database\Factories;

use App\Models\Compliance;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplianceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compliance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'project_name' => $this->faker->text(255),
            'office_id' => \App\Models\Office::factory(),
            'status_id' => \App\Models\Status::factory(),
        ];
    }
}
