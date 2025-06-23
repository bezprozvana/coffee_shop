<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BrewingMethod;

class BrewingMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = ['V-60', 'Гейзер', 'Еспресо', 'Френч-прес', 'Джезва', 'Заварювання'];

        foreach ($methods as $method) {
            BrewingMethod::firstOrCreate(['name' => $method]);
        }
    }
}
