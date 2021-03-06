<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'cities';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'name'
    ];

    /**
     * @param $country
     * @return void
     */
    public function getCityByCountryId($country)
    {
        return City::select('id','name')
        ->where('country_id', $country)
        ->orderBy('name')
            ->get();
    }
    /**
     * @param $search
     * @return mixed
     */
    public function search($search)
    {
        return Company::orderBy('id','DESC')
            ->where('name', 'LIKE', "%$search%")
            ->paginate(30);
    }
}
