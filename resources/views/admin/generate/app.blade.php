@extends("layout.client.app")

@section("title", "Generate QR Code")

@section("content")
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center">
				<h2>Scan Your QR Code</h2>
				<p class="text-muted">Use your mobile device to scan the QR code below and access exclusive content.</p>
				<!-- Assuming you have a variable $qrCodeUrl that holds the URL to the QR code image -->
				<img src="{{ $qr_code_base64 }}" alt="QR Code" class="img-fluid" height="300" width="300">
				<p class="text-muted mt-3">This QR code will expire in Next Day.</p>
			</div>
		</div>
	</div>
@endsection
