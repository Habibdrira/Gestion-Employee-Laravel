@extends('admin.layouts.app')

@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
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
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-6">
        <!-- Inclure le graphique des absences -->
        @include('admin.charts.absenceChart')
    </div>
    <div class="col-md-6">
        <!-- Inclure le graphique des performances -->
        @include('admin.charts.performanceChart')
    </div>
</div>



<!-- Tableau des employés -->
<table class="table border mb-0 mt-4">
    <thead class="table-light fw-semibold">
        <tr class="align-middle">
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Primes</th>
            <th>Performances</th>
            <th>Absences</th>
            <th>Salaire</th> <!-- Nouvelle colonne pour le salaire -->
            <th>Status</th> <!-- Nouvelle colonne pour le statut -->
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
                <td>
                    {{ number_format($employee->salary, 2) }} TND <!-- Affichage du salaire -->
                </td>
                <td>
                    @if($employee->status == 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
