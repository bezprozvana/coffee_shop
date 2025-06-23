<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SweetnessLevel;

class SweetnessLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = ['5/10', '6/10', '7/10', '8/10', '9/10'];

        foreach ($levels as $level) {
            SweetnessLevel::firstOrCreate(['name' => $level]);
        }
    }
}
