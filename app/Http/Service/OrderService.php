<?php


namespace App\Http\Service;


use App\Models\Distance;
use App\Models\Orders;
use App\Models\Prices;
use App\Models\Warehouse;


class OrderService
{
    public function create($data)
    {
      return Orders::create($data)->id;
    }

    public function makeСalculation($data)
    {

        $city_from = Warehouse::checkCity($data['city_id_from']);
        $city_to = Warehouse::checkCity($data['city_id_to']);
        if (!sizeof($city_from) or !sizeof($city_to)) {
            return false;
        }

        $disctance = Distance::getDistance($data['city_id_from'] , $data['city_id_to']);
        $price = Prices::where('company_id', $data['company_id'])
            ->first()
            ->toArray();


        $summ_for_distance = $price['km'] * $disctance['distance'];
        $summ_for_width = $price['kg'] * $data['kg'] ;

        return ($summ_for_distance + $summ_for_width) * ($price['V'] / 100);

    }
}
