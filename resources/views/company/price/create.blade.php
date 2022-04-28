@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Создание Прайса:</h2>
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

    <form action="{{ route('company.price.store') }}" method="POST">
        @csrf
        <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Цена за кг :</strong>
                <input type="text" name="kg" class="form-control" placeholder="ТГ" autocomplete="off">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Цена за км :</strong>
                <input type="text" name="km" class="form-control" placeholder="ТГ" autocomplete="off">
            </div>
        </div>            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Надбавка за объем в процентах :</strong>
                <input type="text" name="V" class="form-control" placeholder="Процент надбавки" autocomplete="off">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
        </div>

    </form>
@endsection
