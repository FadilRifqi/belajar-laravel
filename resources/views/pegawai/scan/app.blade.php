@extends("layout.client.app")

@section("head")
	@vite("resources/js/app.js")
@endsection
@section("title", "Login")

@section("content")
	<h1>QR Code Scanner</h1>
	<div id="reader" style="width: 300px;"></div>
@endsection
