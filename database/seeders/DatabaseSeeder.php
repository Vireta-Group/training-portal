<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(DemoDataSeeder::class);
    }
}
