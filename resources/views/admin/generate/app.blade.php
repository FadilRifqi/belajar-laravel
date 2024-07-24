@extends("layout.client.app")

@section("title", "Admin")

@section("page", "QR Code")

@section("content")
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
				<h2>Scan Your QR Code</h2>
				<p class="text-muted">Use your app to scan this QR Code.</p>
				<!-- Assuming you have a variable $qrCodeUrl that holds the URL to the QR code image -->
				<div class="p-3"
					style="background-color: #DCDCDC; height: 300px; width: 300px; border-radius: 10px; display: flex; justify-content: center; align-items: center;">
					<img src="{{ $qr_code_base64 }}" alt="QR Code" class="img-fluid" style="max-height: 100%; max-width: 100%;">
				</div>
				<p class="text-muted mt-3">This QR code will expire in {{ $qr_code->expired_at->format("l - d/m/Y") }}.</p>
			</div>
		</div>
	</div>
@endsection
