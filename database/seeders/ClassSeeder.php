<?php

namespace Database\Seeders;

use App\Models\SClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SClass::create([
            "name" => "Class One",
            // "sub_name" => "A"
        ]);

        SClass::create([
            "name" => "Class Two",
            // "sub_name" => "A"
        ]);

        SClass::create([
            "name" => "Class Three",
            // "sub_name" => "A"
        ]);
    }
}
