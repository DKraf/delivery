@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Склады:</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (sizeof($data) > 0)
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
           <tr>
               <th>№</th>
               <th>Склад</th>
               <th>Город</th>
               <th>Адрес</th>
           </tr>
           @foreach ($data as $warehouse)
               <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $warehouse->name }}</td>
                   <td>{{ $warehouse->city }} </td>
                   <td>{{ $warehouse->address }}</td>


               </tr>
           @endforeach
        </table>
        </div>
        <a class="btn btn-success" href="{{ route('company.warehouse.create') }}">
            <i class="bi bi-plus"></i>
        </a>
    @else
        <p class="text-center text-danger">Пока нет ни одного Склада!</p>

    @endif
       {!! $data->links() !!}
 @endsection
