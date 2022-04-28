<?php

namespace App\Http\Controllers;

use App\Models\Address;

use DB;

class AddressController extends Controller
{

  public function getAllAddresses($id)
  {
      $addresses = Address::getAllAddresses($id);
      foreach ($addresses as $address){
          $address['address'] = strstr($address['address'], ' ');
      }
      return response()->json($addresses);

  }
}
