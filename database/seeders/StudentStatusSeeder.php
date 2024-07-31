<?php

namespace Database\Seeders;

use App\Models\StudentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentStatus::create([
            "name" => "Active"
        ]);
        StudentStatus::create([
            "name" => "Left / Moved to Another School"
        ]);
        StudentStatus::create([
            "name" => "Graduated"
        ]);
    }
}
