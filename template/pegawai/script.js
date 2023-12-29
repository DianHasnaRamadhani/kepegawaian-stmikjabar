<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var data = {
            labels: ['Pegawai', 'Hadir'],
            datasets: [{
                data: [<?php echo $totalPegawai - $totalAbsenHariIni; ?>, <?php echo $totalAbsenHariIni; ?>],
                backgroundColor: ['#36A2EB', '#FF6384'],
            }]
        };
        var options = {
            responsive: false,
            maintainAspectRatio: false,
        };
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>