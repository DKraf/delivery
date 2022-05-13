<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FileController;
use App\Http\Service\OrderService;
use App\Http\Service\ProductInformationService;
use App\Models\Address;
use App\Models\Country;
use App\Models\documents;
use App\Models\OrderHistory;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;

class OrderController extends Controller
{

public function apply(Request $request, $id)
{
    $role = Orders::find($id);
    $role->price = $request->input('price');
    $role->status_id = 9;
    $role->company_id = $request->input('company_id');
    $role->save();

    return redirect()->route('user.orders.new')
        ->with('success','Компания выбрана! Ждите счет на оплату!');
}
    /**
     * Отобразить список ресурсов. Для Заказчика
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
     * Отобразить список ресурсов. Для Админа
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Orders::oderAdmin();

        return view('user.order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Отобразить список ресурсов. Для Админа
     *
     * @return \Illuminate\Http\Response
     */
    public function indexHistory(Request $request)
    {
        $data = Orders::oderAdmin(0);

        return view('user.order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Отобразить список ресурсов. Для компании
     *
     * @return \Illuminate\Http\Response
     */
    public function transportNews(Request $request)
    {
        $data = Orders::oderCompany();

        return view('user.order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Отобразить список ресурсов. Для таможни
     *
     * @return \Illuminate\Http\Response
     */
    public function customNews(Request $request)
    {
        $data = Orders::oderCustom();

        return view('user.order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Отобразить список ресурсов. Для таможни
     *
     * @return \Illuminate\Http\Response
     */
    public function courierNews(Request $request)
    {
        $data = Orders::oderCurier();

        return view('user.order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Отобразить список ресурсов.Для Заказчика
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
     * Отобразить список ресурсов.Для Компании
     *
     * @return \Illuminate\Http\Response
     */
    public function transportHistory(Request $request)
    {
        $data = Orders::oderCompany(0);

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
        $data['is_active'] = true;
        $data['status_id'] = 13;
        $data['is_custom'] = ($data['country_id_from'] != $data['country_id_to']);

        //расчет стоймости
        $orderService = new OrderService();
        if (!$prices = $orderService->makeСalculation($data)) {
            return redirect()->back()
                ->with('warning', 'К сожелению в этих городах нет представительства');
        };


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


        $data['order_id'] =  Orders::create($data)->id;

        Documents::create(['order_id' => $data['order_id']]);
        OrderHistory::create($data);

        $order = Orders::showOrder($data['order_id']);

        return view('user.order.indexCash',compact('order', 'prices'))
            ->with('success','Заявка создана')
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


    /**
     * Отобразить указанный ресурс.
     *
     * @param int $id
     */
    public function show(int $id)
    {

        $data =  Orders::showOrder($id);
        $history = OrderHistory::getOrderHistory($id);

        return view('user.order.show',compact('data', 'history'));
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
     * Подтверждение
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Request $request, int $id)
    {
        $fileController = new FileController();
        $save_data = $fileController->upload($request);
        $save_data['order_id'] = $id;

        $order_to_update = Orders::find($id);
        $doc_to_update = Documents::where('order_id', $id)->first();

        $doc_to_update->update(($save_data));
        $order_to_update->update(($save_data));

        OrderHistory::create($save_data);

        return redirect()->back()
            ->with('Success', 'Файл успешно загружен!');
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
