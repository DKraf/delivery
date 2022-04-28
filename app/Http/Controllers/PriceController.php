<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prices;
use DB;

class PriceController extends Controller
{

    /**
     * Отобразить форму для создания нового ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.price.create');
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
            'kg' => 'required',
            "km" => 'required',
            "V" => 'required',
        ],
            [
                'kg.required' => 'Цена за вес обязательна',
                'km.required' => 'Цена за км обязательна',
                'v.required' => 'Надбавка за Объем обязательна',
            ]
        );


        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;

        Prices::create($data);

        return redirect()->route('company.price.index')
            ->with('success','Прайс создан!');
    }

public function index(Request $request){
    $data = Prices::orderBy('id','DESC')
        ->paginate(30);
    return view('company.price.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 30);

}



    /**
     * Убрать указанный ресурс из хранилища.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table("prices")->where('id',$id)->delete();
        return redirect()->route('company.price.index')
            ->with('success','Удалено');
    }
}
