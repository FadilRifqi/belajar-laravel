@extends("layout.client.app")

@section("title", "Admin")

@section("head")

@endsection

@section("page", "Solve Ticket")

@section("head")

@endsection

@section("content")
	@if (session("success"))
		<div class="alert alert-success" role="alert">
			{{ session("success") }}
		</div>
	@endif
	@if (session("error"))
		<div class="alert alert-danger" role="alert">
			{{ session("error") }}
		</div>
	@endif
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Detail Ticket</div>

					<div class="card-body">
						<h3 class="card-title" style="font-size: 1.4rem">Title: {{ $ticket->title }}</h3>
						<p class="card-text"><span style="font-size: 1.2rem">Deskripsi: </span>{{ $ticket->description }}</p>
						<p class="card-text"><small class="text-muted">Status: {{ $ticket->status->status_name }}</small></p>

						<form action="{{ route("ticket.close", $ticket->id) }}" method="POST" style="display: inline-block;">
							@csrf
							@method("PUT")
							<button type="submit" class="btn btn-info">Done</button>
						</form>

						<a href="{{ route("ticket.admin") }}" class="btn btn-secondary">Back</a>
					</div>
				</div>
			</div>
		</div>
	@endsection
