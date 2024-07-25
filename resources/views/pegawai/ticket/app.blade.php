@extends("layout.client.app")

@section("head")

@endsection

@section("title", auth()->user()->divisi->nama)

@section("page", "Open Ticket")

@section("content")
	@if (session("success"))
		<div class="alert alert-success">
			{{ session("success") }}
		</div>
	@endif

	@if (session("error"))
		<div class="alert alert-danger">
			{{ session("error") }}
		</div>
	@endif
	<form action="{{ route("ticket") }}" method="POST" class="mt-4">
		@csrf <!-- CSRF token for security -->

		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" class="form-control" id="title" name="title" required>
		</div>

		<div class="form-group">
			<label for="description">Description:</label>
			<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
		</div>

		<button type="submit" class="btn btn-info">Submit Ticket</button>
	</form>
@endsection
