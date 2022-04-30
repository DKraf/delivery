<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Status;

class Orders extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * Атрибуты, которые можно назначать массово.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'company_id',
        'country_id_from',
        'city_id_from',
        'country_id_to',
        'city_id_to',
        'address_id_from',
        'address_id_to',
        'status_id',
        'price',
        'is_active',
        'is_custom'
    ];

    /**
     * @param $order_id
     * @return mixed
     */
    public function getOrder($order_id)
    {
        return Orders::where('id', $order_id);
    }

    /**
     * @param $status
     * @return mixed
     */
    public function getOrderByStatus($status)
    {
        return Orders::where('status_id', (new Status)->getStatusByName($status))
        ->paginate(30);
    }

    public function oderListSelf($status = 1)
    {
       return  Orders::orderBy('updated_at','DESC')
            ->leftJoin('product_information', 'orders.product_id', '=', 'product_information.id')
            ->leftJoin('company', 'orders.company_id', '=', 'company.id')
            ->leftJoin('cities as cto', 'orders.city_id_to', '=', 'cto.id')
            ->leftJoin('cities as cfrom' , 'orders.city_id_from', '=', 'cfrom.id')
            ->leftJoin('statuses' , 'orders.status_id', '=', 'statuses.id')

            ->select
            (
                'orders.*',
                'product_information.name as product',
                'cto.name as city_to',
                'cfrom.name as city_from',
                'company.name as company',
                'statuses.name as status'
            )
            ->where('orders.user_id' , Auth::user()->id)
            ->where('orders.is_active' , $status)

            ->paginate(5);
    }
    public function oderAdmin($status = 1)
    {
        return  Orders::orderBy('updated_at','DESC')
            ->leftJoin('product_information', 'orders.product_id', '=', 'product_information.id')
            ->leftJoin('company', 'orders.company_id', '=', 'company.id')
            ->leftJoin('cities as cto', 'orders.city_id_to', '=', 'cto.id')
            ->leftJoin('cities as cfrom' , 'orders.city_id_from', '=', 'cfrom.id')
            ->leftJoin('statuses' , 'orders.status_id', '=', 'statuses.id')

            ->select
            (
                'orders.*',
                'product_information.name as product',
                'cto.name as city_to',
                'cfrom.name as city_from',
                'company.name as company',
                'statuses.name as status'
            )
            ->where('orders.is_active' , $status)
            ->paginate(5);
    }

    public function oderCompany($status = 1)
    {
        return  Orders::orderBy('updated_at','DESC')
            ->leftJoin('product_information', 'orders.product_id', '=', 'product_information.id')
            ->leftJoin('company', 'orders.company_id', '=', 'company.id')
            ->leftJoin('cities as cto', 'orders.city_id_to', '=', 'cto.id')
            ->leftJoin('cities as cfrom' , 'orders.city_id_from', '=', 'cfrom.id')
            ->leftJoin('statuses' , 'orders.status_id', '=', 'statuses.id')

            ->select
            (
                'orders.*',
                'product_information.name as product',
                'cto.name as city_to',
                'cfrom.name as city_from',
                'company.name as company',
                'statuses.name as status'
            )
            ->where('orders.company_id' , Auth::user()->company_id)
            ->where('orders.is_active' , $status)

            ->paginate(5);
    }

    public function oderCustom($status = 1)
    {
        return  Orders::orderBy('updated_at','DESC')
            ->leftJoin('product_information', 'orders.product_id', '=', 'product_information.id')
            ->leftJoin('company', 'orders.company_id', '=', 'company.id')
            ->leftJoin('cities as cto', 'orders.city_id_to', '=', 'cto.id')
            ->leftJoin('cities as cfrom' , 'orders.city_id_from', '=', 'cfrom.id')
            ->leftJoin('statuses' , 'orders.status_id', '=', 'statuses.id')

            ->select
            (
                'orders.*',
                'product_information.name as product',
                'cto.name as city_to',
                'cfrom.name as city_from',
                'company.name as company',
                'statuses.name as status'
            )
            ->where('status_id', '=', 6)
            ->where('orders.is_active' , $status)
            ->paginate(5);
    }
    public function oderCurier($status = 1)
    {
        return  Orders::orderBy('updated_at','DESC')
            ->leftJoin('product_information', 'orders.product_id', '=', 'product_information.id')
            ->leftJoin('company', 'orders.company_id', '=', 'company.id')
            ->leftJoin('cities as cto', 'orders.city_id_to', '=', 'cto.id')
            ->leftJoin('cities as cfrom' , 'orders.city_id_from', '=', 'cfrom.id')
            ->leftJoin('statuses' , 'orders.status_id', '=', 'statuses.id')

            ->select
            (
                'orders.*',
                'product_information.name as product',
                'cto.name as city_to',
                'cfrom.name as city_from',
                'company.name as company',
                'statuses.name as status'
            )
            ->where('orders.company_id' , Auth::user()->company_id)
            ->where(function ($query) {
                $query->where('status_id', '=', 1)
                    ->orWhere('status_id', '=', 12);
            })
            ->where('orders.is_active' , $status)
            ->paginate(5);
    }
    public function showOrder($id)
    {
        return Orders::find($id)
            ->leftJoin('product_information', 'orders.product_id', '=', 'product_information.id')
            ->leftJoin('company', 'orders.company_id', '=', 'company.id')
            ->leftJoin('cities as cto', 'orders.city_id_to', '=', 'cto.id')
            ->leftJoin('cities as cfrom' , 'orders.city_id_from', '=', 'cfrom.id')

            ->leftJoin('address as ato', 'orders.address_id_to', '=', 'ato.id')
            ->leftJoin('address as afrom' , 'orders.address_id_from', '=', 'afrom.id')

            ->leftJoin('country as coto', 'orders.country_id_to', '=', 'coto.id')
            ->leftJoin('country as cofrom' , 'orders.country_id_from', '=', 'cofrom.id')

            ->leftJoin('statuses' , 'orders.status_id', '=', 'statuses.id')
            ->leftJoin('documents', 'orders.id', '=' , 'documents.order_id')
            ->leftJoin('users', 'orders.user_id', '=' , 'users.id')

            ->select
            (
                'orders.price',
                'orders.id as number',
                'orders.status_id as status_id',

                'documents.*',

                'product_information.name as product',
                'product_information.kg as kg',
                'product_information.H as H',
                'product_information.L as L',
                'product_information.V as V',
                'product_information.S as S',

                'ato.address as address_to',
                'afrom.address as address_from',

                'coto.name as country_to',
                'cofrom.name as country_from',

                'cto.name as city_to',
                'cfrom.name as city_from',

                'company.name as company',
                'statuses.name as status',

                'users.first_name as first_name',
                'users.last_name as last_name',
                'users.email as email',

            )
            ->where('orders.id', $id)
            ->first();
    }
}
