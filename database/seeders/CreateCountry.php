<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CreateCountry extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            'Россия',
            'Беларусь',
            'Казахстан'
        ];

        foreach ($countries as $country) {
            Country::create(['name' => $country]);
        }
    }
}
