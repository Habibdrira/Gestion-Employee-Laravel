<!-- resources/views/charts/performanceChart.blade.php -->
<div class="col-12 col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4>Graphique des Performances</h4>
        </div>
        <div class="card-body">
            <canvas id="performanceChart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', // Type de graphique en ligne
            data: {
                labels: @json($performanceCountsByDay->keys()),
                datasets: [{
                    label: 'Performance moyenne',
                    data: @json($performanceCountsByDay->map(function($performance) { return $performance->avg('rating'); })),
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            });
    });
</script>
