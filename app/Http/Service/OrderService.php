<?php


namespace App\Http\Service;


use App\Models\Company;
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
        if (!is_array($company = $this->getNeedCompany($data))) {
            return false;
        }
        return $company;
    }

    private function getNeedCompany($data)
    {
        $outData = false;
        $allCompanies = Company::select('id', 'name')->get()->toArray();
        $disctance = Distance::getDistance($data['city_id_from'] , $data['city_id_to']);

        foreach ($allCompanies as $company){
            $city_from = Warehouse::checkCity($data['city_id_from'], $company['id'] );
            $city_to = Warehouse::checkCity($data['city_id_to'], $company['id']);

            if (sizeof($city_from) and sizeof($city_to)) {
                $price = Prices::where('company_id', $company['id'])
                    ->first()
                    ->toArray();

                $summ_for_distance = $price['km'] * $disctance['distance'];
                $summ_for_width = $price['kg'] * $data['kg'] ;

                $outData[] = [
                    'price'     => ($summ_for_distance + $summ_for_width) * ($price['V'] / 100),
                    'company_id'=> $company['id'],
                    'company'   => $company['name']
                    ];
            }
        }
        return $outData;
    }

}
