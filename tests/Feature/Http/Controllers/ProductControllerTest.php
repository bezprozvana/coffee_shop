<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AcidityLevel;
use App\Models\BitternessLevel;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\ProcessingMethod;
use App\Models\Product;
use App\Models\SweetnessLevel;
use App\Models\Weight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertOk();
        $response->assertViewIs('product.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = fake()->name();
        $price = fake()->randomFloat(/** decimal_attributes **/);
        $description = fake()->text();
        $stock_quantity = fake()->numberBetween(-10000, 10000);
        $brand = Brand::factory()->create();
        $weight = Weight::factory()->create();
        $country = Country::factory()->create();
        $category = Category::factory()->create();
        $acidity_level = AcidityLevel::factory()->create();
        $sweetness_level = SweetnessLevel::factory()->create();
        $bitterness_level = BitternessLevel::factory()->create();
        $processing_method = ProcessingMethod::factory()->create();

        $response = $this->post(route('products.store'), [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'stock_quantity' => $stock_quantity,
            'brand_id' => $brand->id,
            'weight_id' => $weight->id,
            'country_id' => $country->id,
            'category_id' => $category->id,
            'acidity_level_id' => $acidity_level->id,
            'sweetness_level_id' => $sweetness_level->id,
            'bitterness_level_id' => $bitterness_level->id,
            'processing_method_id' => $processing_method->id,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('price', $price)
            ->where('description', $description)
            ->where('stock_quantity', $stock_quantity)
            ->where('brand_id', $brand->id)
            ->where('weight_id', $weight->id)
            ->where('country_id', $country->id)
            ->where('category_id', $category->id)
            ->where('acidity_level_id', $acidity_level->id)
            ->where('sweetness_level_id', $sweetness_level->id)
            ->where('bitterness_level_id', $bitterness_level->id)
            ->where('processing_method_id', $processing_method->id)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $name = fake()->name();
        $price = fake()->randomFloat(/** decimal_attributes **/);
        $description = fake()->text();
        $stock_quantity = fake()->numberBetween(-10000, 10000);
        $brand = Brand::factory()->create();
        $weight = Weight::factory()->create();
        $country = Country::factory()->create();
        $category = Category::factory()->create();
        $acidity_level = AcidityLevel::factory()->create();
        $sweetness_level = SweetnessLevel::factory()->create();
        $bitterness_level = BitternessLevel::factory()->create();
        $processing_method = ProcessingMethod::factory()->create();

        $response = $this->put(route('products.update', $product), [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'stock_quantity' => $stock_quantity,
            'brand_id' => $brand->id,
            'weight_id' => $weight->id,
            'country_id' => $country->id,
            'category_id' => $category->id,
            'acidity_level_id' => $acidity_level->id,
            'sweetness_level_id' => $sweetness_level->id,
            'bitterness_level_id' => $bitterness_level->id,
            'processing_method_id' => $processing_method->id,
        ]);

        $product->refresh();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($name, $product->name);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($description, $product->description);
        $this->assertEquals($stock_quantity, $product->stock_quantity);
        $this->assertEquals($brand->id, $product->brand_id);
        $this->assertEquals($weight->id, $product->weight_id);
        $this->assertEquals($country->id, $product->country_id);
        $this->assertEquals($category->id, $product->category_id);
        $this->assertEquals($acidity_level->id, $product->acidity_level_id);
        $this->assertEquals($sweetness_level->id, $product->sweetness_level_id);
        $this->assertEquals($bitterness_level->id, $product->bitterness_level_id);
        $this->assertEquals($processing_method->id, $product->processing_method_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertModelMissing($product);
    }
}
