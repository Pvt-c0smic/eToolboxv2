<?php

namespace Database\Seeders;

use App\Models\PersonnelType;
use Illuminate\Database\Seeder;

class PersonnelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonnelType::factory()
            ->count(5)
            ->create();
    }
}
