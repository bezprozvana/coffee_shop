<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AcidityLevelsTableSeeder::class,
            SweetnessLevelsTableSeeder::class,
            BitternessLevelsTableSeeder::class,
            ProcessingMethodsTableSeeder::class,
            BrewingMethodsTableSeeder::class,
            CategoriesTableSeeder::class,
            WeightsTableSeeder::class,
            BrandsTableSeeder::class,
            CountriesTableSeeder::class,
            OrderStatusesTableSeeder::class,
            DeliveryMethodsTableSeeder::class,
            ProductsTableSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
