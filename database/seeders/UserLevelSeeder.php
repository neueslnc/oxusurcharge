<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserLevel::create(['name' => "super_admin", "level" => 1]);
        \App\Models\UserLevel::create(['name' => "admin", "level" => 2]);
        \App\Models\UserLevel::create(['name' => "user", "level" => 3]);
    }
}
