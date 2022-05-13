<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Orders;
use App\Models\Warehouse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;


class TrackerController extends BaseController
{
    public function getForMyOrder($id)
    {
        $order = Orders::find($id)->first();

        $addressFirst = Address::where('id', $order->address_id_to)->first();
        $json['data1'] = [
            'Latitude'=> $addressFirst->latitude,
            'Longitude' => $addressFirst->longitude
            ];

        $warehouse = Warehouse::where('company_id', $order->company_id)
            ->where('city_id', $order->city_id_to)
            ->first();

        $addressSecond = Address::where('id', $warehouse->address_id)->first();

        $json['data2'] = [
            'Latitude' => $addressSecond->latitude,
            'Longitude' => $addressSecond->longitude
            ];

        $json = json_encode($json);
        $path = Storage::path('code.py');

        $path = __FILE__ .'code.py' ;

        passthru("python3 $path", $as);
        echo $as;


    }

}
