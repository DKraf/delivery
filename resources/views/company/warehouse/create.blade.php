@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Создание склада:</h2>
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

    <form action="{{ route('company.warehouse.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Страна :</strong>
                    <select class="form-control" name="country_id_from" aria-label="Default select example">
                        <option selected>Укажите страну </option>
                        @foreach ($countries as $key => $value)
                            <option value="{{$key}}">{{$countries[$key]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="hiden-select-city-from" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Город :</strong>
                    <select id="city_id_from" class="form-control" name="city_id_from" aria-label="Default select example">
                        <option selected>Укажите город</option>
                    </select>
                </div>
            </div>

            <div id="hiden-select-address-from" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Адрес :</strong>
                    <select id="select-address-from" class="form-control" name="address_id_from" aria-label="Default select example">
                        <option selected>Укажите адрес </option>
                    </select>
                </div>
            </div>
            <div id="hiden-input-address-from" class="col-xs-12 col-sm-12 col-md-12" hidden="true">
                <div class="form-group">
                    <strong>Адрес :</strong>
                    <input type="text" name="address_name_from" class="form-control" placeholder="Адрес местонахождения " autocomplete="off">
                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Наименование :</strong>
                    <input type="text" name="name" class="form-control" placeholder="Наименование склада" autocomplete="off">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </div>
    </form>
@endsection
