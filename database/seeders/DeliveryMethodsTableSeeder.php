<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryMethod;

class DeliveryMethodsTableSeeder extends Seeder
{
    public function run(): void
    {
        $methods = ['Нова Пошта', 'Укрпошта', 'Кур’єр'];

        foreach ($methods as $method) {
            DeliveryMethod::firstOrCreate(['name' => $method]);
        }
    }
}