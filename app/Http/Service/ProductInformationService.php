<?php


namespace App\Http\Service;


use App\Models\ProductInformation;


class ProductInformationService
{
    public function create($data)
    {
      return ProductInformation::create($data)->id;
    }
}
