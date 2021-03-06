@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавить нового пользователя:</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}">
                    <i class="bi bi-arrow-return-left"></i>
                </a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Упс!</strong> Ошибка Ввода!!!<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Имя:</strong>
                {!! Form::text('first_name', null, array('placeholder' => 'Имя','class' => 'form-control','id'=>'lastname_input')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Фамилия:</strong>
                {!! Form::text('last_name', null, array('placeholder' => 'Фамилия','class' => 'form-control', 'id'=>'firstname_input')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Отчество:</strong>
                {!! Form::text('patronymic', null, array('placeholder' => 'Отчество','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Логин:</strong>
                {!! Form::text('login', null, array('placeholder' => 'Логин','class' => 'form-control text-danger', 'id'=>'login_input')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Пароль:</strong>
                {!! Form::text('password', $pass, array('value'  => $pass,'class' => 'form-control text-danger')) !!}
                <input type="text" name="confirm-password" value="{{ $pass }}" class="form-control" placeholder="Name" hidden>

            </div>
        </div>
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}

{{--                <strong>Повторите пароль:</strong>--}}
{{--                {!! Form::text('confirm-password', $pass, array('value' => $pass,'class' => 'form-control')) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Организация:</strong>
                {!! Form::select('company_id', $company, null, array('class' => 'form-control','placeholder' => 'Выберите компанию')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Должность:</strong>
                {!! Form::select('position_id', $position,null, array('class' => 'form-control', 'placeholder' => 'Выберите должность')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Роль:</strong>
                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
