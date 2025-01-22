<div style="width: 600px; height: 400px;">
    <canvas id="weeklyPerformanceChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('weeklyPerformanceChart').getContext('2d');
    
    // Transmet les données du contrôleur à la vue
    const weeklyPerformanceData = @json($weeklyPerformanceData); // Moyenne des performances par semaine
    const labels = Object.keys(weeklyPerformanceData); // Récupérer les semaines
    const data = Object.values(weeklyPerformanceData); // Moyenne des performances

    const performanceChart = new Chart(ctx, {
        type: 'line', // Type de graphique
        data: {
            labels: labels, // Semaines de l'année
            datasets: [{
                label: 'Performance Hebdomadaire', // Légende
                data: data, // Données de performance
                borderColor: 'rgb(75, 192, 192)', // Couleur de la ligne
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
                            return tooltipItem.raw + ' points'; // Format du tooltip
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
