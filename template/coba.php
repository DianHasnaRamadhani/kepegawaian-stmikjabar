<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagram Pegawai Absen</title>
    <!-- Sertakan pustaka Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

    <!-- Bagian HTML untuk menampilkan diagram pie -->
    <div id="chart_div" style="width: 400px; height: 400px;"></div>

    <!-- Bagian JavaScript untuk memuat data dan menggambar diagram pie -->
    <!-- Bagian JavaScript untuk memuat data dan menggambar diagram pie -->
	<script type="text/javascript">
	    google.charts.load('current', {'packages':['corechart']});
	    google.charts.setOnLoadCallback(drawChart);

	    function drawChart() {
	        var jsonData = $.ajax({
	            url: "hitung_absen.php",
	            dataType: "json",
	            async: false
	        }).responseText;

	        var data = JSON.parse(jsonData);

	        var options = {
	            title: 'Diagram Pegawai Absen',
	            slices: {
	                0: { color: 'green' },
	                1: { color: 'red' }
	            }
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	        chart.draw(google.visualization.arrayToDataTable([
	            ['Status', 'Jumlah'],
	            ['Sudah Absen', data.sudah_absen],
	            ['Belum Absen', data.belum_absen]
	        ]), options);
	    }
	</script>
</body>
</html>
