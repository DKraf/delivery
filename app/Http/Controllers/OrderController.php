<?php

namespace App\Http\Controllers;

use App\Http\Service\OrderService;
use App\Http\Service\ProductInformationService;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\documents;
use App\Models\Orders;
use App\Models\ProductInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class OrderController extends Controller
{
    /**
     * Отобразить список ресурсов.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
//        $this->middleware('permission:role-create', ['only' => ['create','store']]);
//        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Отобразить список ресурсов.
     *
     * @return \Illuminate\Http\Response
     */
    public function news(Request $request)
    {
        $data = Orders::oderListSelf();

        return view('user.order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Отобразить список ресурсов.
     *
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        $data = Orders::oderListSelf(0);

        return view('user.order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Отобразить форму для создания нового ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','id')->all();
        return view('user.order.create',compact('countries'));
    }


    /**
     * Поместить только что созданный ресурс в хранилище.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'country_id_from' => 'required',
            'country_id_to' => 'required',
            "city_id_from" => 'required',
            "city_id_to" => 'required',
            "name" => 'required',
            "kg" => 'required',
            "H" => 'required',
            "L" => 'required',
            "S" => 'required',
            "V" => 'required'
        ],
            [
                'country_id_from.required' => 'Страна отправки не может быть пустой',
                'country_id_to.required' => 'Страна получения не может быть пустой',
                'city_id_from.required' => 'Город отправки не может быть пустой',
                'city_id_to.required' => 'Город получения не может быть пустой',
                'kg.required' => 'Вес отправки не может быть пустой',
                'H.required' => 'Высота отправки не может быть пустой',
                'L.required' => 'Длина  не может быть пустой',
                'S.required' => 'Ширина не может быть пустой',
                'V.required' => 'Объем не может быть пустой'
            ]
        );


        //Проверяем Адрес отправки если не в Алматы то дописываем новый и получаем айди привязав к городу
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['company_id'] = 1;
        $data['is_active'] = true;
        $data['status_id'] = 9;

        //расчет стоймости
        $orderService = new OrderService();
        if (!$price = $orderService->makeСalculation($data)) {
            return redirect()->back()
                ->with('warning', 'К сожелению в этих городах нет представительства');
        };

        $data['price'] = $price;

        if ($data['address_name_from']) {
            $data['address_id_from'] = Address::create([
                'name'       => null,
                'type'       => null,
                'address'    => $data['address_name_from'],
                'latitude'   => null,
                'longitude ' => null,
                'city_id'    => $data['city_id_from']
            ])->id;
        }

        //Проверка адреса доставки, если не возможно то пишем NULL
        if (!$data['address_name_to'] && !is_numeric($data['address_id_to'])) {
            $data['address_id_to'] = null;
        }

        $productInformation = new ProductInformationService();
        $data['product_id'] = $productInformation->create($data);


       $order_id =  Orders::create($data)->id;

        Documents::create(['order_id' => $order_id]);

        return redirect()->route('user.orders.new')
            ->with('success','Заявка создана!');
    }


    /**
     * Отобразить указанный ресурс.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): \Illuminate\Http\Response
    {

        $data = $data = Orders::showOrder($id);
dd($data);
        return view('user.order.show',compact('data'));
    }


    /**
     * Обновить указанный ресурс в хранилище.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success','Роль успешно обновлена');
    }


    /**
     * Убрать указанный ресурс из хранилища.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Роль успешно удалена');
    }
}
