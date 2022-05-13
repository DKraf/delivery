@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Информация о заказе №  {{ $data->number }}</h2>
                @if($data->city_id_to == 1 && $data->address_id_to < 763)
                <h6>Загрузить маршрут от склада до ТТ
                    <a class="btn btn-warning"
                       href="https://2gis.kz/almaty" target="_blank">
                        <i class="bi bi-signpost-2"></i>
                    </a>
                </h6>
                    @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Наименование груза:</strong>
                {{ $data->product }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Высота груза:</strong>
                {{ $data->H }}м
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ширина груза:</strong>
                {{ $data->S }}м
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Длина груза:</strong>
                {{ $data->L }}м
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Объем груза (куб.м):</strong>
                {{ $data->V }} м.куб.
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Полный Адрес Отправки:</strong>
                {{ $data->country_from }},  {{ $data->city_from }},  {{ $data->address_from }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Полный Адрес Получения:</strong>
                {{ $data->country_to }},  {{ $data->city_to }},  {{ $data->address_to }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Данные грузополучателя:</strong>
                {{ $data->first_name }} {{ $data->last_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email</strong>
                {{ $data->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Статус:</strong>
                {{ $data->status }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Сумма:</strong>
                {{ $data->price }} тг.
            </div>
        </div>
    </div>

{{--ДОКУМЕНТЫ ЗАЯВКИ--}}
   <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Документы</h2>
        </div>
    </div>
    </div>
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
           <tr>
               <th>Счет</th>
               <th>Оплата</th>
               <th>Накладная курьеру</th>
               <th>Накладная склада отпраки</th>
               <th>Накладная склада приема</th>
               <th>Накладная склада доставки</th>
               <th>Накладная ТТ</th>
               <th>Таможенная деклорация</th>
               <th>Накладная о выдаче</th>
           </tr>
            </thead>
            <tbody>
               <tr>
                   <th>
                       @if ($data->score)
                           <a class="btn btn-success"
                              download="{{$data->score}}"
                              href="{{ Storage::url($data->score) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>
                       @if ($data->payment)
                           <a class="btn btn-success"
                              download="{{$data->payment}}"
                              href="{{ Storage::url($data->payment) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>@if ($data->to_courier_from)
                           <a class="btn btn-success"
                              download="{{$data->to_courier_from}}"
                              href="{{ Storage::url($data->to_courier_from) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>@if ($data->to_warehous_from)
                           <a class="btn btn-success"
                              download="{{$data->to_warehous_from}}"
                              href="{{ Storage::url($data->to_warehous_from) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>@if ($data->to_warehous_to)
                           <a class="btn btn-success"
                              download="{{$data->to_warehous_to}}"
                              href="{{ Storage::url($data->to_warehous_to) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>@if ($data->to_drive)
                           <a class="btn btn-success"
                              download="{{$data->to_drive}}"
                              href="{{ Storage::url($data->to_drive) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>@if ($data->to_courier_to)
                           <a class="btn btn-success"
                              download="{{$data->to_courier_to}}"
                              href="{{ Storage::url($data->to_courier_to) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>@if ($data->to_customs)
                           <a class="btn btn-success"
                              download="{{$data->to_customs}}"
                              href="{{ Storage::url($data->to_customs) }}">
                               <i class="bi bi-download"></i>
                           </a>
                       @else
                           Нет
                       @endif
                   </th>
                   <th>@if ($data->to_received)
                           <a class="btn btn-success"
                              download="{{$data->to_received}}"
                              href="{{ Storage::url($data->to_received) }}">
                           <i class="bi bi-download"></i>
                       </a>
                       @else
                           Нет
                       @endif
                   </th>
               </tr>
            <tbody>
        </table>
        </div>


    {{--    ФУНКЦИОНАЛ ПО РОЛЯМ--}}
    {{--    {{-КОМПАНИ-}}--}}
    @role('Компания')
    @if ($data->status_id == 9 && !$data->score)
        <form action="{{ route('approvescore', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="1" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Для подтверждения нужно прикрепить Счет на оплату</strong>
                        <input type="file" name="score" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @elseif ($data->status_id == 2 && !$data->to_warehous_from)
        <form action="{{ route('approvewarehousfrom', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="3" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Курьер привез товар на отправку! Прикрепите копию акта получения груза!</strong>
                        <input type="file" name="to_warehous_from" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @elseif ($data->status_id == 3 && !$data->to_drive)
        <form action="{{ route('approvetodrive', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="4" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Товар Загружен, отправлен на склад города выдачи</strong>
                        <input type="file" name="to_drive" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @elseif ($data->status_id == 4 && !$data->to_warehous_to)
        <form action="{{ route('approvewarehousto', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value= "@if($data->country_from == $data->country_to) 12 @else 6 @endif "class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Товар Доставлен на склад города выдачи! прикрепите накладную!</strong>
                        <input type="file" name="to_warehous_to" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @endif
    @endrole
    {{--    {{-ЗАКАЗЧИК-}}--}}
    @role('Заказчик')
    @if ($data->status_id == 1 && !$data->payment)
        <form action="{{ route('approvepayment', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="11" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Подтвердите оплату , прикрепив документ оплаты</strong>
                        <input type="file" name="payment" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @elseif ($data->status_id == 8 && !$data->to_received)
        <form action="{{ route('approvereceived', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="10" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Прикрепите копию акта получения груза!</strong>
                        <input type="file" name="to_received" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @endif
    @endrole

    {{--    {{-КУРЬЕР-}}--}}
    @role('Курьер')
    @if ($data->status_id == 11 && !$data->to_courier_from)
        <form action="{{ route('approvecourierfrom', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="2" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Подтвердите что вы забрали груз и везете его на Склад, прикрипите акт приема!</strong>
                        <input type="file" name="to_courier_from" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @elseif ($data->status_id == 12 && !$data->to_courier_to)
        <form action="{{ route('approvecourierto', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="8" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Подтвердите что вы забрали груз и везете его на пункт выдачи, прикрипите акт приема!</strong>
                        <input type="file" name="to_courier_to" class="form-control"  accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @endif
    @endrole
    {{--    {{-Таможня-}}--}}
    @role('Таможня')
    @if ($data->status_id == 6 && !$data->to_customs)
        <form action="{{ route('approvecustoms', $data->number)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="12" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Подтвердите растоможку товара, прикрепив томоженную декларацию</strong>
                        <input type="file" name="to_customs" class="form-control" accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @endif
    @endrole


    {{--    ИСТОРИЯ ЗАЯВКИ--}}
    @if (sizeof($history) > 0)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>История Заказа</h2>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Статус</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($history as $hi)
            <tr>
                <th>{{$hi->status}}</th>
                <th>{{$hi->created_at}}</th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
 @endsection
