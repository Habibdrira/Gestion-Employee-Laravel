@extends('employee.layouts.app')

@section('title', 'Mes demandes de congé')

@section('content')
<!-- Section du graphique -->
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">🎯 Mon Bilan des Congés</h2>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
        <canvas id="congeChart" style="max-width: 250px; max-height: 250px;"></canvas>
    </div>

    <!-- Script pour afficher le graphique -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('congeChart').getContext('2d');
            const congeUtilise = {{ $nbrjcongeUtilise }};
            const nbrCongeTotal = {{ $nbrjcongeTotal }};
            const restant = nbrCongeTotal - congeUtilise;

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Congés utilisés', 'Congés restants'],
                    datasets: [{
                        data: [congeUtilise, restant],
                        backgroundColor: ['#007bff', '#28a745'],
                        borderColor: ['#007bff', '#28a745'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14,
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw} jours`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>

<!-- Section des demandes de congé -->
<div class="container mt-5">
    <h2 class="text-center mb-4">📋 Mes demandes de congé</h2>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tableau des demandes -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Type</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                    <tr>
                        <td class="text-center">{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</td>
                        <td class="text-center">{{ ucfirst($demande->type) }}</td>
                        <td class="text-center">
                            @if($demande->statut === 'Approuvé')
                                <span class="badge bg-success">✔ Approuvé</span>
                            @elseif($demande->statut === 'En attente')
                                <span class="badge bg-warning text-dark">⏳ En attente</span>
                            @elseif($demande->statut === 'Rejeté')
                                <span class="badge bg-danger">❌ Rejeté</span>
                            @else
                                <span class="badge bg-secondary">Inconnu</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucune demande de congé trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
