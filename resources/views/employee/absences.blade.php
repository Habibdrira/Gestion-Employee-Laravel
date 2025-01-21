@extends('employee.layouts.app')

@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Absences</span></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div style="width: 100%; height: 400px;">
            <canvas id="weeklyAbsenceChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('weeklyAbsenceChart').getContext('2d');

    // Transmet les données du contrôleur à la vue
    const weeklyAbsenceData = @json($weeklyAbsenceData); // Somme des durées d'absences par semaine
    const labels = Object.keys(weeklyAbsenceData); // Semaines de l'année
    const data = Object.values(weeklyAbsenceData); // Durée des absences

    const absenceChart = new Chart(ctx, {
        type: 'line', // Type de graphique
        data: {
            labels: labels, // Semaines de l'année
            datasets: [{
                label: 'Absences Hebdomadaires', // Légende
                data: data, // Données des absences
                borderColor: 'rgb(255, 99, 132)', // Couleur de la ligne
                tension: 0.1, // Courbure de la ligne
                fill: false // Ne pas remplir sous la courbe
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw + ' heures'; // Format du tooltip
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Commencer l'axe Y à zéro
                }
            }
        }
    });
</script>
@endsection
