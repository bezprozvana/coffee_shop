<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcidityLevel;
class AcidityLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = ['4/10', '5/10', '6/10', '7/10', '8/10'];

    foreach ($levels as $level) {
        AcidityLevel::firstOrCreate(['name' => $level]);
    }
    }
}
