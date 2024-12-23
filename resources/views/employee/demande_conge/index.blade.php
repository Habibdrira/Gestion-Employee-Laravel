@extends('employee.layouts.app')

@section('title', 'Mes demandes de congé')

@section('content')
<!-- Section du graphique -->
<div class="container mt-5">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('employee.dashboard') }}" class="text-decoration-underline text-dark">
            ← Retour au Dashboard
        </a>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <h3>Mon nombre total de congés</h3>
        </div>
    </div>

    <div style="display: flex; justify-content: center; align-items: center; height: 300px;">
        <canvas id="congeChart" style="max-width: 200px; max-height: 200px;"></canvas>
    </div>

    <!-- Script pour afficher le graphique -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.onload = function() {
            var ctx = document.getElementById('congeChart').getContext('2d');

            // Variables pour les données du graphique
            var congeUtilise = {{ $nbrjcongeUtilise }}; // Jours de congé utilisés
            var nbrCongeTotal = {{ $nbrjcongeTotal }}; // Nombre total de jours de congé
            var restant = nbrCongeTotal - congeUtilise; // Congés restants

            // Créer un graphique circulaire
            var congeChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Congés utilisés', 'Congés restants'],
                    datasets: [{
                        data: [congeUtilise, restant],
                        backgroundColor: ['#007bff', '#dc3545'], 
                        borderColor: ['#007bff', '#dc3545'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Garder les proportions
                    plugins: {
                        legend: {
                            position: 'top',
                            display: true // Afficher la légende
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + ' jours';
                                }
                            }
                        }
                    }
                }
            });
        };
    </script>

    <!-- Section des demandes de congé -->
    <h1 class="text-center mb-4">📋 Mes demandes de congé</h1>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tableau des demandes -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered mt-4">
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
                        <td colspan="4" class="text-center">Aucune demande de congé trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
            
        </table>
    </div>
</div>
@endsection
