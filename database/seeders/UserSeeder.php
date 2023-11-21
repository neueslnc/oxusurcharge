<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(['login' => "super_admin_1", "full_name" => "Talim Sifat 1", "password" => Hash::make('1111'), 'level_id' => 1]);

        \App\Models\User::create(['login' => "super_admin_2", "full_name" => "Talim Sifat 2", "password" => Hash::make('2222'), 'level_id' => 1]);

        \App\Models\User::create(['login' => "super_admin_3", "full_name" => "Talim Sifat 3", "password" => Hash::make('3333'), 'level_id' => 1]);

        \App\Models\User::create(['login' => "n.alisher", "departament_id" => 1, "full_name" => "Shadiyev Alisher Xudoynazarovich", "password" => Hash::make('654321'), 'level_id' => 2]);

        // \App\Models\User::create(['login' => "kafedra_1", "departament_id" => 1, "full_name" => "Otkir Sabirov", "password" => Hash::make('1111'), 'level_id' => 2]);

        // \App\Models\User::create(['login' => "kafedra_2", "departament_id" => 2, "full_name" => "Rustam Dehoanov", "password" => Hash::make('1111'), 'level_id' => 2]);

        // \App\Models\User::create(['login' => "f.mironshox", "departament_id" => 2, "full_name" => "Fayzulaev Mironshox", "password" => Hash::make('1111'), 'level_id' => 3]);

        // \App\Models\User::create(['login' => "f.rahmatov", "departament_id" => 2, "full_name" => "Rahmatov Feruz", "password" => Hash::make('1111'), 'level_id' => 3]);

        // \App\Models\User::create(['login' => "r.usmanov", "departament_id" => 1, "full_name" => "Usamnov Rustam", "password" => Hash::make('1111'), 'level_id' => 3]);
    }
}
