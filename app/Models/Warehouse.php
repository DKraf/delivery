<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Warehouse extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'warehouse';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company_id',
        'city_id',
        'address_id',
        'country_id'
    ];

   public function checkCity($id)
   {
       return Warehouse::select('id')
           ->where('city_id', $id)
           ->get()->toArray();
   }
    /**
     * @param $search
     * @return mixed
     */
    public function search($search)
    {
        return Warehouse::orderBy('id','DESC')
            ->where('name', 'LIKE', "%$search%")
            ->paginate(30);
    }

    public function warehouses()
    {
        return $this->hasMany('App\Models\City');
    }
}
