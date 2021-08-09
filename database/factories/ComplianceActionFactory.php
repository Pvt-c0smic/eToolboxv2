<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ComplianceAction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplianceActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComplianceAction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'action_taken' => $this->faker->text,
            'commander_comment' => $this->faker->text,
            'percentage' => $this->faker->randomNumber(2),
            'updated_date' => $this->faker->date,
            'compliance_id' => \App\Models\Compliance::factory(),
        ];
    }
}
