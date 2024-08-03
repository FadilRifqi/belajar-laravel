@extends("layout.client.app")

@section("title", "Admin")
@section("head")

@endsection

@section("page", "Dashboard")

@section("content")
	<div class="container">
		<h2>Data Presensi Pegawai</h2>
		<canvas id="myPieChart"></canvas>
	</div>
@endsection

@section("script")
	<script>
		var data = @json($data);
		var label = @json($label);
		var backgroundColor = @json($backgroundColor);
		document.addEventListener('DOMContentLoaded', function() {
			var ctx = document.getElementById('myPieChart').getContext('2d');
			var currentYear = new Date().getFullYear();

			var myPieChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: label,
					datasets: [{
						label: 'Presensi Pegawai ' + currentYear,
						data: data, // Dummy data
						backgroundColor: backgroundColor,
					}],
				},
				options: {
					responsive: true,
					maintainAspectRatio: true,
				}
			});
		});
	</script>
@endsection
