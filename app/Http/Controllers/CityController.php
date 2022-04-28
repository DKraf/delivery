<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class CityController extends Controller
{

  public function getCitiesByCountry($id)
  {
      $cities = City::getCityByCountryId($id);
      return response()->json($cities);

  }
}
