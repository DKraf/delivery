<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Address  extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'Address';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'address',
        'latitude',
        'longitude',
        'city_id'
    ];

    /**
     * @param $city_id
     * @return void
     */
    public function getAllAddresses($city_id)
    {
        return Address::select('id','address', 'type', 'name')
            ->where('city_id', $city_id)
            ->orderBy('address')
            ->get();
    }

    /**
     * @param $search
     * @return mixed
     */
    public function search($search)
    {
        return Address::orderBy('id','DESC')
            ->where('name', 'LIKE', "%$search%")
            ->paginate(30);
    }
}
