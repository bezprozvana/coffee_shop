<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'El Naranjo',
                'description' => 'Ніжна кава з нотками карамелі й апельсинової цедри.',
                'brand_id' => 1,
                'country_id' => 1,
                'weight_id' => 4,
                'category_id' => 1,
                'image' => 'El_Naranjo.png',
                'acidity_level_id' => 3,
                'sweetness_level_id' => 4,
                'bitterness_level_id' => 2,
                'processing_method_id' => 2,
                'price' => 320,
                'stock_quantity' => 50
            ],
            [
                'name' => 'Kulturrra Blend',
                'description' => 'Насичений смак з нотами темного шоколаду.',
                'brand_id' => 2,
                'country_id' => 3,
                'weight_id' => 4,
                'category_id' => 1,
                'image' => 'Kulturrra_Blend.png',
                'acidity_level_id' => 2,
                'sweetness_level_id' => 3,
                'bitterness_level_id' => 4,
                'processing_method_id' => 1,
                'price' => 295,
                'stock_quantity' => 40
            ],
            [
                'name' => 'Bacara Easydrip',
                'description' => 'Ідеально підходить для подорожей або офісу.',
                'brand_id' => 3,
                'country_id' => 2,
                'weight_id' => 1,
                'category_id' => 2,
                'image' => 'Bacara_Easydrip.png',
                'acidity_level_id' => 4,
                'sweetness_level_id' => 2,
                'bitterness_level_id' => 3,
                'processing_method_id' => 3,
                'price' => 120,
                'stock_quantity' => 100
            ],
        ];

        foreach ($products as $data) {
            Product::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
