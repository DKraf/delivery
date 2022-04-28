@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Информация о заказе №  {{ $data->number }}</h2>
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
               <tr>
                   <th>@if ($data->score) {{$data->score}} @else - @endif</th>
                   <th>@if ($data->payment) {{$data->payment}} @else - @endif</th>
                   <th>@if ($data->to_courier_from) {{$data->to_courier_from}} @else - @endif</th>
                   <th>@if ($data->to_warehous_from) {{$data->to_warehous_from}} @else - @endif</th>
                   <th>@if ($data->to_warehous_to) {{$data->to_warehous_to}} @else - @endif</th>
                   <th>@if ($data->to_drive) {{$data->to_drive}} @else - @endif</th>
                   <th>@if ($data->to_courier_to) {{$data->to_courier_to}} @else - @endif</th>
                   <th>@if ($data->to_customs) {{$data->to_customs}} @else - @endif</th>
                   <th>@if ($data->to_received) {{$data->to_received}} @else - @endif</th>
               </tr>
        </table>
        </div>
    {{--    ФУНКЦИОНАЛ ПО РОЛЯМ--}}
    {{--    {{-КОМПАНИ-}}--}}
    @role('Компания')
    @if ($data->status_id == 9)
        <form action="{{ route('approvescore', $data->number)}}" method="POST">
            @csrf
            <div class="row">
                <input type="text" name="status_id" value="1" class="form-control" hidden="true">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong style="color:red">Для подтверждения нужно прикрепить Счет на оплату</strong>
                        <input type="file" name="score" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </form>
    @endif
        @endrole
    {{--    {{-Пользователь-}}--}}
    @role('Заказчик')
    @endrole

    {{--    {{-Пользователь-}}--}}
    @role('Курьер')
    @endrole
    {{--    {{-Таможня-}}--}}
    @role('Таможня')
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
            <tr>
                <th>Статус</th>
                <th>Дата</th>
            </tr>
            @foreach ($history as $hi)
            <tr>
                <th>{{$hi->status}}</th>
                <th>{{$hi->created_at}}</th>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
 @endsection
