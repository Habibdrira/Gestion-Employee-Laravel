<!-- resources/views/admin/charts/workMinutesByDayChart.blade.php -->
<div style="width: 600px; height: 400px;">
    <canvas id="workMinutesChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('workMinutesChart').getContext('2d');
    const workMinutesChart = new Chart(ctx, {
        type: 'line', // Type de graphique
        data: {
            labels: @json($daysOfWeek), // Jours de la semaine
            datasets: [{
                label: 'Minutes de travail par jour',
                data: @json($workMinutesData), // Données des minutes de travail
                borderColor: 'rgb(75, 192, 192)', // Couleur de la ligne
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
