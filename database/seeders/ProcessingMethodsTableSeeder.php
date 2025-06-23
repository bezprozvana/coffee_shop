<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProcessingMethod;

class ProcessingMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = ['Мита', 'Натуральна', 'Анаеробна', 'Декаф', 'Карбонічна мацерація'];

        foreach ($methods as $method) {
            ProcessingMethod::firstOrCreate(['name' => $method]);
        }
    }
}
