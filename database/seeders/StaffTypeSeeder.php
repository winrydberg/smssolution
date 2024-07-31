<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\StaffType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StaffType::create([
            "name" => "Teacher"
        ]);
        StaffType::create([
            "name" => "Driver"
        ]);
        StaffType::create([
            "name" => "Cook"
        ]);
        StaffType::create([
            "name" => "Accountant"
        ]);
    }
}
