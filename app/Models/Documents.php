<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Documents extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'documents';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'to_courier_from',
        'to_warehous_from',
        'to_warehous_to',
        'to_drive',
        'to_courier_to',
        'to_customs',
        'to_received',
        'score',
        'payment'
    ];



}
