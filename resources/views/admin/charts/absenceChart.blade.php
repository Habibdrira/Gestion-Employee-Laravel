<!-- resources/views/charts/absenceChart.blade.php -->
<div class="col-12 col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4>Graphique des Absences</h4>
        </div>
        <div class="card-body">
            <canvas id="absenceChart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('absenceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Type de graphique en barres
            data: {
                labels: @json($absenceCountsByDay->keys()), // Jours de la semaine
                datasets: [{
                    label: 'Absences',
                    data: @json($absenceCountsByDay->map(function($absence) { return $absence->count(); })),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
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
