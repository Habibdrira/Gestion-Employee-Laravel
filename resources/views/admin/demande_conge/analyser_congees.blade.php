@extends('admin.layouts.app')

@section('title', 'Analyse des Congés')

@section('content')
<div class="container">
    <!-- Bouton de retour au Dashboard -->


    <h2 class="text-center mb-4 text-primary fw-bold">Analyse des Congés pour la Planification des Ressources</h2>

    <!-- Formulaire de filtre -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-gradient-primary text-white">
            <h5 style="color: black"><i class="bi bi-funnel"></i> Filtrer les Congés</h5>
        </div>
        <div class="card-body bg-light">
            <form action="{{ route('admin.demande_conge.analyser_congees') }}" method="GET">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label fw-bold">Date de début</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label fw-bold">Date de fin</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100 mt-3 mt-md-0">
                            <i class="bi bi-search"></i> Appliquer le Filtre
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Résultat de l'analyse -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-gradient-success text-white">
            <h5 style="color: black"><i class="bi bi-graph-up-arrow" ></i> Résultat de l'Analyse</h5>
        </div>
        <div class="card-body bg-light">
            <h6 class="text-secondary">Nombre d'employés disponibles :</h6>
            @if ($availableEmployees->isNotEmpty())
                <p class="fw-bold text-success">
                    <i class="bi bi-people-fill"></i> {{ $availableEmployees->count() }} employés disponibles
                </p>
                <ul class="list-group list-group-flush">
                    @foreach ($availableEmployees as $employee)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-person-circle"></i> {{ $employee->name }}</span>
                            <span class="text-muted">{{ $employee->email }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-danger">
                    <i class="bi bi-exclamation-triangle-fill"  ></i> Aucun employé disponible pour la période sélectionnée.
                </p>
            @endif
        </div>
    </div>

    <!-- Diagramme -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-info text-white">
            <h5 style="color: black"><i class="bi bi-bar-chart-line"></i> Disponibilités par Position</h5>
        </div>
        <div class="card-body bg-light">
            <canvas id="availabilityChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Script pour afficher le graphique -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartData = @json($chartData);

        const labels = chartData.map(data => data.position || 'Non spécifié');
        const counts = chartData.map(data => data.count);

        const ctx = document.getElementById('availabilityChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre d\'employés disponibles',
                    data: counts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' employés';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
