<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fee::create([
            "name" => "School Fees",
            "amount" => 500,
            "applies_on" => "ALL",
        ]);

        Fee::create([
            "name" => "Transportation Fees",
            "amount" => 800,
            "applies_on" => "ALL",
        ]);
    }
}
