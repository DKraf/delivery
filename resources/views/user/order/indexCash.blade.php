@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif($message = Session::get('warning'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Расчеты от компаний:</h2>
            </div>
        </div>
    </div>
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
           <tr>
               <th>№</th>
               <th>Груз</th>
               <th>Город отправки</th>
               <th>Город доставки</th>
               <th>ТК</th>
               <th>Цена</th>
           </tr>
           @foreach ($prices as $price)
               <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $order->product }} </td>
                   <td>{{ $order->city_from }} </td>
                   <td>{{ $order->city_to }} </td>
                   <td>{{ $price['company'] }}</td>
                   <td>{{ $price['price'] }} </td>
                   <td>
                       <form action="{{ route('user.order.apply',$order->id) }}" method="POST">
                           @csrf
                           <input type="price" name="price" class="form-control"  value="{{ $price['price'] }}" hidden="true">
                           <input type="text" name="company_id" class="form-control" value="{{ $price['company_id'] }}" hidden="true">
                           <button type="submit" class="btn btn-success">Выбрать</button>
                       </form>
                   </td>
               </tr>
           @endforeach
        </table>
        </div>
 @endsection
