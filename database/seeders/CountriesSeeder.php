<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (!Country::query()->first()) {
            $countriesData = json_decode(
                Storage::disk('local')->get('imports/countries.json'),
                true
            );
            Country::query()->insert($countriesData);
        }
    }
}
