<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Mad Heads',
            'Kulturrra',
            'Bacara',
            'High Hill',
            'Foundation',
            '25 Coffee Rousters',
            'FreshBlack',
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(['name' => $brand]);
        }
    }
}
