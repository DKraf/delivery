<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Prices extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'prices';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'kg', //цена за кг
        'km', //Надбавка за растояние
        'V'   //Надбавка за объём
    ];

    /**
     * @param $company_id
     * @return mixed
     */
    public function getPrice($company_id)
    {
        return Prices::where('company_id', $company_id)
            ->first();
    }
    /**
     * @param $search
     * @return mixed
     */
    public function search($search)
    {
        return Prices::orderBy('id','DESC')
            ->where('name', 'LIKE', "%$search%")
            ->paginate(30);
    }
}
