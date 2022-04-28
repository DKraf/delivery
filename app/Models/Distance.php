<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Distance extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'distance';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'city_from',
        'city_to',
        'distance'
    ];

    public function getDistance($from, $to)
    {
       return Distance::select('distance')
        ->where([
                ['city_from', '=', $from],
                ['city_to', '=', $to],
            ])
           ->orWhere([
               ['city_from', '=', $to],
               ['city_to', '=', $from],
           ])
           ->first()
           ->toArray();
    }
}
