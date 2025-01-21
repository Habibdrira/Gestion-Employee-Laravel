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

<!-- Courbes des absences et des performances par semaine -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Absences par semaine</div>
            <div class="card-body">
                <div id="absencesChart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Performances moyennes par semaine</div>
            <div class="card-body">
                <div id="performancesChart"></div>
            </div>
        </div>
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
@endsection



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    console.log('Absences Data:', absencesData);
console.log('Performances Data:', performancesData);
console.log('Days of Week:', daysOfWeek);

    // Données des absences et des performances
    const absencesData = @json($absenceData);
    const performancesData = @json($performanceData);
    const daysOfWeek = @json($daysOfWeek);


    var options = {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: 'Test Series',
        data: [10, 20, 30, 40, 50, 60, 70]
    }],
    xaxis: {
        categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
    }
};

var chart = new ApexCharts(document.querySelector("#absencesChart"), options);
chart.render();

    // Configuration du graphique des absences
    var absencesChartOptions = {
        chart: {
            type: 'line',
            height: 350,
        },
        series: [{
            name: 'Absences',
            data: absencesData
        }],
        xaxis: {
            categories: daysOfWeek
        },
        title: {
            text: 'Absences par semaine',
            align: 'center'
        },
    };

    // Configuration du graphique des performances
    var performancesChartOptions = {
        chart: {
            type: 'line',
            height: 350,
        },
        series: [{
            name: 'Performances moyennes',
            data: performancesData
        }],
        xaxis: {
            categories: daysOfWeek
        },
        title: {
            text: 'Performances moyennes par semaine',
            align: 'center'
        },
    };

    // Initialisation des graphiques
    var absencesChart = new ApexCharts(document.querySelector("#absencesChart"), absencesChartOptions);
    var performancesChart = new ApexCharts(document.querySelector("#performancesChart"), performancesChartOptions);

    absencesChart.render();
    performancesChart.render();
</script>
@endsection
