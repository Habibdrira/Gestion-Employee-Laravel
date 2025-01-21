<!-- resources/views/admin/charts/workMinutesByWeekChart.blade.php -->
<div style="width: 600px; height: 400px;">
    <canvas id="workMinutesByWeekChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('workMinutesByWeekChart').getContext('2d');
    const workMinutesByWeekChart = new Chart(ctx, {
        type: 'line', // Type de graphique (ligne)
        data: {
            labels: @json($weeksOfYear), // Semaines de l'année
            datasets: [{
                label: 'Minutes de travail par semaine',
                data: @json($workMinutesByWeekData), // Données des minutes de travail par semaine
                borderColor: 'rgb(54, 162, 235)', // Couleur de la ligne
                tension: 0.1, // Tension de la ligne (courbure)
                fill: false
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
                            return tooltipItem.raw + ' minutes';
                        }
                    }
                }
            }
        }
    });
</script>
