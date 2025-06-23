<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weights', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Наприклад: "250 г"
            $table->decimal('value', 5, 2);   // Наприклад: 0.25 (для сортування або обрахунків)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weights');
    }
};
