<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CreateCity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['country_id' => 3, 'city' => 'Алматы'],
            ['country_id' => 1, 'city' => 'Москва'],
            ['country_id' => 2, 'city' => 'Новосибирск'],
            ['country_id' => 1, 'city' => 'Санкт-Питербург'],
            ['country_id' => 1, 'city' => 'Челябинск'],
            ['country_id' => 2, 'city' => 'Минск'],
            ['country_id' => 2, 'city' => 'Брест'],
            ['country_id' => 3, 'city' => 'Нур-султан'],
            ['country_id' => 3, 'city' => 'Шымкент'],
            ['country_id' => 3, 'city' => 'Караганда'],
            ['country_id' => 3, 'city' => 'Семей'],
            ['country_id' => 3, 'city' => 'Атырау'],
            ['country_id' => 3, 'city' => 'Усть-Каменогорск'],
            ['country_id' => 3, 'city' => 'Актобе'],
            ['country_id' => 3, 'city' => 'Павлодар'],
            ['country_id' => 3, 'city' => 'Тараз'],
            ['country_id' => 3, 'city' => 'Туркестан'],
            ['country_id' => 3, 'city' => 'Кокшетау'],
            ['country_id' => 3, 'city' => 'Талдыкорган'],
            ['country_id' => 3, 'city' => 'Актау']
        ];

        foreach ($countries as $country) {
            City::create([
                'country_id' => $country['country_id'],
                'name'       => $country['city'],
            ]);
        }
    }
}
