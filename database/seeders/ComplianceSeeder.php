<?php

namespace Database\Seeders;

use App\Models\Compliance;
use Illuminate\Database\Seeder;

class ComplianceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compliance::factory()
            ->count(5)
            ->create();
    }
}
