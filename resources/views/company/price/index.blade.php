@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Прайсы:</h2>
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
                    <th>Цена за кг</th>
                    <th>Цена за км</th>
                    <th>Надбавка за куб (в %)</th>
                    <th>Действие</th>
                </tr>
                @foreach ($data as $price)
                <tr>
                    <td>{{ $price->kg }}</td>
                    <td>{{ $price->km }} </td>
                    <td>{{ $price->V }}</td>
                    <td> <a class="btn btn-danger" href="{{ route('company.price.delete', $price->id) }}">
                            <i class="bi bi-file-x"></i>
                        </a></td>
                </tr>
                @endforeach
            </table>
        </div>

    @else
        <p class="text-center text-danger">Пока нет ни одного Прайса!</p>
        <a class="btn btn-success" href="{{ route('company.price.create') }}">
            <i class="bi bi-journal-plus"></i>
        </a>
    @endif
    {!! $data->links() !!}
@endsection
