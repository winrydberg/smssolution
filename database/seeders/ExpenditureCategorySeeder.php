<?php

namespace Database\Seeders;

use App\Models\ExpenditureCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenditureCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpenditureCategory::create([
            "name" => "Salary & Wages"
        ]);

        ExpenditureCategory::create([
            "name" => "Transportation"
        ]);

        ExpenditureCategory::create([
            "name" => "Groceries"
        ]);
    }
}
