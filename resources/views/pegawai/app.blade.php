@extends("layout.client.app")

@section("title", "Pegawai")

@section("head")

@endsection

@section("page", "Dashboard")

@section("content")
	<div class="row">
		<h1>Dashboard</h1>
	</div>
@endsection

@section("script")
	<script>
		var presensi = @json($presensi)
		console.log(presensi);
	</script>
@endsection
