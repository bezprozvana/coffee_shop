<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Бразилія',
            'Гватемала',
            'Гондурас',
            'Кенія',
            'Колумбія',
            'Коста-Ріка',
            'Руанда',
            'Сальвадор',
            'Ефіопія',
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(['name' => $country]);
        }
    }
}
