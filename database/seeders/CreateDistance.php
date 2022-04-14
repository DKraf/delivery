<?php

namespace Database\Seeders;

use App\Models\Distance;
use Illuminate\Database\Seeder;

class CreateDistance  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distanceis = [
            ['city_from' => 2, 'city_to' => 1, 'distance' => 3916],
        ];

        foreach ($distanceis as $d) {
            Distance::create([
                'city_from' => $d['city_from'],
                'city_to' => $d['city_to'],
                'distance' => $d['distance'],
            ]);
        }
    }
}
