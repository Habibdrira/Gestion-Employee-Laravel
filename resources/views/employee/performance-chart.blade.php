@extends('employee.layouts.app')
@section('content')
<div class="container">
    <h1 class="my-4">Mon Diagramme de Performance</h1>
    <canvas id="performanceChart" width="400" height="200"></canvas>
</div>

<!-- Inclure Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(ctx, {
            type: 'line', // Type de graphique : ligne
            data: {
                labels: @json($dates), // Dates des performances
                datasets: [{
                    label: 'Évaluation',
                    data: @json($ratings), // Évaluations des performances
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Dates',
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Évaluation',
                        },
                        min: 0,
                        max: 10, // Échelle de 0 à 10
                    }
                }
            }
        });
    });
</script>
@endsection