@extends("layout.client.app")

@section("title", "Pegawai")

@section("content")
	<div class="row">
		<div class="col-md-4">
			<h2>Feature One</h2>
			<p>Explain feature one here. A short and engaging description works best.</p>
			<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
		</div>
		<div class="col-md-4">
			<h2>Feature Two</h2>
			<p>Describe feature two. Remember to keep it interesting and relevant.</p>
			<p><a class="btn btn-secondary" href="{{ route("scan") }}" role="button">Scan</a></p>
		</div>
		<div class="col-md-4">
			<h2>Feature Three</h2>
			<p>Feature three can be anything that adds value to your users.</p>
			<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
		</div>
	</div>
@endsection
