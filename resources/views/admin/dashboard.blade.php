@extends('admin.layouts.app')


@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>

        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    @foreach($cards as $card)
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-{{ $card['color'] }}">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ $card['value'] }}
                        </div>
                        <div>{{ $card['label'] }}</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="{{ $card['chart_id'] }}" height="70"></canvas>
                </div>
            </div>
        </div>
    @endforeach
</div>


<table class="table border mb-0">
    <thead class="table-light fw-semibold">
        <tr class="align-middle">
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Primes</th>
            <th>Performances</th>
            <th>Absences</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->user->name }}</td>
                <td>{{ $employee->user->email }}</td>
                <td>
                    @foreach ($employee->primes as $prime)
                        {{ $prime->amount }} TND<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($employee->performances as $performance)
                        {{ $performance->rating }}<br>
                    @endforeach
                </td>
                <td>
                    {{ $employee->absences->count() }} absences
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


        
    </div>
    <!-- /.col-->
</div>
<!-- /.row-->
@endsection
