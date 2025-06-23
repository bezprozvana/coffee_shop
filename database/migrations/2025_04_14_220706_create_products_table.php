<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->decimal('price', 10, 2)->index();
            $table->text('description')->fulltext();
            $table->string('image')->nullable();
            $table->integer('stock_quantity')->default(0)->index();

            $table->foreignId('brand_id')->constrained('brands')->onDelete('restrict');
            $table->foreignId('weight_id')->constrained('weights')->onDelete('restrict');
            $table->foreignId('country_id')->constrained('countries')->onDelete('restrict');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('acidity_level_id')->constrained('acidity_levels')->onDelete('restrict');
            $table->foreignId('sweetness_level_id')->constrained('sweetness_levels')->onDelete('restrict');
            $table->foreignId('bitterness_level_id')->constrained('bitterness_levels')->onDelete('restrict');
            $table->foreignId('processing_method_id')->constrained('processing_methods')->onDelete('restrict');

            $table->index(['category_id', 'price']);
            $table->index(['country_id', 'processing_method_id']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
