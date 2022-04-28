<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Company extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'company';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'bin',
        'phone',
        'name'
    ];


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

    public function getCompaniesForCalculation($city_from, $city_to){
        return Company::orderBy('id','DESC')
            ->selectRaw('count(id) as number_of_orders, customer_id')
            ->groupBy('customer_id')
            ->havingBetween('number_of_orders', [5, 15])
            ->get();
    }
}
