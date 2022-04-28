@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Создание заявки на грузоперевозку:</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}">
                    <i class="bi bi-arrow-return-left"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('warning'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Упс!</strong> Ошибка Ввода!!!<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.order.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Страна отправки:</strong>
                    <select class="form-control" name="country_id_from" aria-label="Default select example">
                        <option selected>Укажите страну отправки</option>
                        @foreach ($countries as $key => $value)
                            <option value="{{$key}}">{{$countries[$key]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="hiden-select-city-from" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Город отправки:</strong>
                    <select id="city_id_from" class="form-control" name="city_id_from" aria-label="Default select example">
                        <option selected>Укажите город отправки</option>
                    </select>
                </div>
            </div>

            <div id="hiden-select-address-from" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Адрес отправки:</strong>
                    <select id="select-address-from" class="form-control" name="address_id_from" aria-label="Default select example">
                        <option selected>Укажите адрес доставки</option>
                    </select>
                </div>
            </div>
            <div id="hiden-input-address-from" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Адрес отправки:</strong>
                    <input type="text" name="address_name_from" class="form-control" placeholder="Адрес местонахождения груза" autocomplete="off">
                </div>

            </div>

            {{--Адрес доставки--}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Страна прибытия:</strong>
                    <select class="form-control" name="country_id_to" aria-label="Default select example">
                        <option selected>Укажите страну прибытия</option>
                        @foreach ($countries as $key => $value)
                            <option value="{{$key}}">{{$countries[$key]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="hiden-select-city-to" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Город прибытия:</strong>
                    <select id="city_id_to" class="form-control" name="city_id_to" aria-label="Default select example">
                        <option selected>Укажите город прибытия</option>
                    </select>
                </div>
            </div>

            <div id="hiden-select-address-to" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Адрес доставки:</strong>
                    <select id = "select-address-to" class="form-control" name="address_id_to" aria-label="Default select example">
                        <option selected>Укажите адрес удобного для вас пункта выдачи</option>
                    </select>
                </div>
            </div>
            <div id="hiden-input-address-to" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Адрес доставки:</strong>
                    <strong style="color:red">В вашем городе нет курьеров, груз можно забрать на СКЛАДЕ</strong>
                    <input type="text" name="address_name_to" class="form-control"  autocomplete="off" hidden="true">
                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Что везем?:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Наименование груза" autocomplete="off">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Вес груза:</strong>
                    <input type="text" name="kg" class="form-control" placeholder="Вес груза">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Высота:</strong>
                    <input type="text" name="H" class="form-control" placeholder="Высота">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Длина:</strong>
                    <input type="text" name="L" class="form-control" placeholder="Длина">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ширина:</strong>
                    <input type="text" name="S" class="form-control" placeholder="Ширина">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Объем(в кубических сантиментрах):</strong>
                    <input type="text" name="V" class="form-control" placeholder="Объем">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Подать заявку</button>
            </div>
        </div>

    </form>
@endsection
