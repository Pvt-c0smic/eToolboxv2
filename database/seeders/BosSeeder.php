<?php

namespace Database\Seeders;

use App\Models\Bos;
use Illuminate\Database\Seeder;

class BosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bos::factory()
            ->count(5)
            ->create();
    }
}
