<?php

namespace App\Http\Controllers;

use App\Http\Service\OrderService;
use App\Http\Service\ProductInformationService;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\Orders;
use App\Models\ProductInformation;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class WarehouseController extends Controller
{
    /**
     * Отобразить список ресурсов.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    }


    /**
     * Отобразить форму для создания нового ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','id')->all();
        return view('company.warehouse.create',compact('countries'));
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
            "city_id_from" => 'required',
            "name" => 'required',

        ],
            [
                'country_id_from.required' => 'Страна отправки не может быть пустой',
                'city_id_from.required' => 'Город  не может быть пустой',
            ]
        );


        //Проверяем Адрес отправки если не в Алматы то дописываем новый и получаем айди привязав к городу
        $data = $request->all();
        $save_data['company_id'] = Auth::user()->company_id;
        $save_data['city_id'] = $data['city_id_from'];
        $save_data['name'] = $data['name'];
        $save_data['country_id'] = $data['country_id_from'];
        if ($data['address_name_from']) {
            $save_data['address_id'] = Address::create([
                'name'       => null,
                'type'       => null,
                'address'    => $data['address_name_from'],
                'latitude'   => null,
                'longitude ' => null,
                'city_id'    => $data['city_id_from']
            ])->id;
        } else {
            $save_data['address_id'] = $data['address_id_from'];
        }

        Warehouse::create($save_data);

        return redirect()->route('company.warehouse.index')
            ->with('success','Заявка создана!');
    }

public function index(Request $request){
    $data = Warehouse::orderBy('warehouse.id','DESC')
        ->leftJoin('company', 'warehouse.company_id', '=', 'company.id')
        ->leftJoin('cities', 'warehouse.city_id', '=', 'cities.id')
        ->leftJoin('address', 'warehouse.address_id', '=', 'address.id')
        ->leftJoin('country', 'warehouse.country_id', '=', 'country.id')
        ->select
        (
            'warehouse.*',
            'cities.name as city',
            'address.address as address',
            'country.name as country'
        )
        ->where('company_id', Auth::user()->company_id)
        ->paginate(30);
    return view('company.warehouse.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 30);

}
    /**
     * Отобразить указанный ресурс.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('admin.roles.show',compact('role','rolePermissions'));
    }


    /**
     * Отобразить форму для редактирования указанного
     * ресурса.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
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
