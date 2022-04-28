<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Status;

class OrderHistory extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'order_history';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'status_id',
    ];

    /**
     * @param $order_id
     * @return mixed
     */
    public function getOrderHistory($order_id)
    {
       return  OrderHistory::orderBy('created_at','DESC')
            ->leftJoin('statuses' , 'order_history.status_id', '=', 'statuses.id')
            ->select
            (
                'order_history.*',
                'statuses.name as status'
            )
            ->where('order_history.order_id' , $order_id)
            ->get();
    }
}
