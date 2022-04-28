@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добро пожаловать Личный кабинет доставки товара</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Вы находитесь в личном кабинете онлайн заказов доставки груза.
                           Для оформления заявки перейдите и заполните форму по ссылки ниже') }}
                        @role('Заказчик')
                        <div>
                            <a class="btn btn-outline-danger btn-lg btn-block" href="{{ route('user.order.index')}}">
                                Оформить заказ
                            </a>
                        </div>
                        @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
