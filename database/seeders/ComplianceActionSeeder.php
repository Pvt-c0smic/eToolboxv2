<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComplianceAction;

class ComplianceActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComplianceAction::factory()
            ->count(5)
            ->create();
    }
}
