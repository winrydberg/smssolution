<?php

namespace Database\Seeders;

use App\Models\SubClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubClass::create([
            "name" => "A"
        ]);
        SubClass::create([
            "name" => "B"
        ]);
        SubClass::create([
            "name" => "C"
        ]);
    }
}
