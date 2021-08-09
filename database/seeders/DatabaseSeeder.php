<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(BosSeeder::class);
        $this->call(PersonnelTypeSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(PersonnelSeeder::class);
        $this->call(ComplianceActionSeeder::class);
        $this->call(ComplianceSeeder::class);
        $this->call(StatusSeeder::class);
    }
}
