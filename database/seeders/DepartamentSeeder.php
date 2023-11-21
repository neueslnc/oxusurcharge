<?php

namespace Database\Seeders;

use App\Models\Departament;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Departament::create(['name' => "Kafedra - 1"]);
        // Departament::create(['name' => "Kafedra - 2"]);
        Departament::create(['name' => "Iqtisodiyot"]);
    }
}
