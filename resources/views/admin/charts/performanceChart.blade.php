<div style="width: 600px; height: 400px;">
    <canvas id="performanceChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx2 = document.getElementById('performanceChart').getContext('2d');
    const performanceChart = new Chart(ctx2, {
        type: 'line', // Type de graphique
        data: {
            labels: @json($daysOfWeek), // Jours de la semaine
            datasets: [{
                label: 'Performance moyenne par jour',
                data: @json($performanceData), // Données de performance
                borderColor: 'rgb(28, 138, 28)', // Couleur de la ligne
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
                            return tooltipItem.raw.toFixed(2) + ' points'; // Formater la valeur avec 2 décimales
                        }
                    }
                }
            }
        }
    });
</script>
