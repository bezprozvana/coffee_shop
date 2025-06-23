<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BitternessLevel;

class BitternessLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = ['2/10', '3/10', '4/10', '5/10'];

        foreach ($levels as $level) {
            BitternessLevel::firstOrCreate(['name' => $level]);
        }
    }
}
