<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusesTableSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Очікує', 'Обробляється', 'Відправлено', 'Доставлено', 'Скасовано'];

        foreach ($statuses as $status) {
            OrderStatus::firstOrCreate(['name' => $status]);
        }
    }
}
