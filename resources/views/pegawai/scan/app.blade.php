@extends("layout.client.app")

@section("head")
	@vite("resources/js/app.js")
	@vite("resources/css/scan.css")
@endsection

@section("title", auth()->user()->divisi->nama)

@section("page", "Scan Presensi")

@section("content")
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 text-center">
				<h1>QR Code Scanner</h1>
				<div id="reader"></div>
			</div>
		</div>
	</div>
@endsection
