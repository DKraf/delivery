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
                <h2>Заявки:</h2>
            </div>
        </div>
    </div>
    @if (sizeof($data) > 0)
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
           <tr>
               <th>№</th>
               <th>Груз</th>
               <th>Город отправки</th>
               <th>Город доставки</th>
               <th>ТК</th>
               <th>Цена</th>
               <th>Статус</th>
           </tr>
           @foreach ($data as $order)
               <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $order->product }} </td>
                   <td>{{ $order->city_from }} </td>
                   <td>{{ $order->city_to }} </td>
                   <td>{{ $order->company }}</td>
                   <td>{{ $order->price }} </td>
                   <td>{{ $order->status }} </td>
                   <td>
                       <a class="btn btn-success" href="{{ route('user.order.show',$order->id) }}">
                           <i class="bi bi-play-btn"></i>
                       </a>
                   </td>
               </tr>
           @endforeach
        </table>
        </div>
    @else
        <p class="text-center text-danger">Пока нет ни одного заказа</p>
    @endif
       {!! $data->links() !!}
 @endsection
