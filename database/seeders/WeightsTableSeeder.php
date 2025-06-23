<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Weight;

class WeightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weights = [
            ['name' => '60 г', 'value' => 0.06],
            ['name' => '100 г', 'value' => 0.10],
            ['name' => '200 г', 'value' => 0.20],
            ['name' => '250 г', 'value' => 0.25],
            ['name' => '1000 г', 'value' => 1.00],
        ];

        foreach ($weights as $weight) {
            Weight::firstOrCreate(['name' => $weight['name']], ['value' => $weight['value']]);
        }
    }
}
