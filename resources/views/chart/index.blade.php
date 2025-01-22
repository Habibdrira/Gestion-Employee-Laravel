<!-- resources/views/chart.blade.php -->
<html>
    <head>
        <title>Graphique Test</title>
        @vite(['resources/js/app.js', 'resources/sass/style.scss'])
    </head>
    <body>
        <div style="width: 600px; height: 400px;">
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Exemple de données',
                        data: [12, 19, 3, 5, 2, 3, 7],
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                }
            });
        </script>
    </body>
</html>
