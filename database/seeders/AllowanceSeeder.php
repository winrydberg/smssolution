<?php

namespace Database\Seeders;

use App\Models\Allowance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Allowance::create([
            "name" => "None",
            "amount" => 0.00
        ]);
        Allowance::create([
            "name" => "Transportation Allowance",
            "amount" => 100.00
        ]);
        Allowance::create([
            "name" => "Entertainment Allowance",
            "amount" => 50.00
        ]);
    }
}
