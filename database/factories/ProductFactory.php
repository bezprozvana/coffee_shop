<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AcidityLevel;
use App\Models\BitternessLevel;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\ProcessingMethod;
use App\Models\Product;
use App\Models\SweetnessLevel;
use App\Models\Weight;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 0, 99999999.99),
            'description' => fake()->text(),
            'image' => fake()->word(),
            'stock_quantity' => fake()->numberBetween(-10000, 10000),
            'brand_id' => Brand::factory(),
            'weight_id' => Weight::factory(),
            'country_id' => Country::factory(),
            'category_id' => Category::factory(),
            'acidity_level_id' => AcidityLevel::factory(),
            'sweetness_level_id' => SweetnessLevel::factory(),
            'bitterness_level_id' => BitternessLevel::factory(),
            'processing_method_id' => ProcessingMethod::factory(),
            'deleted_at' => fake()->dateTime(),
        ];
    }
}
