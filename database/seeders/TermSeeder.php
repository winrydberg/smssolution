<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Term::create([
            "name" => "First Term",
            "active" => true
        ]);
        Term::create([
            "name" => "Second Term",
            "active" => false
        ]);
        Term::create([
            "name" => "Third Term",
            "active" => false
        ]);
    }
}
