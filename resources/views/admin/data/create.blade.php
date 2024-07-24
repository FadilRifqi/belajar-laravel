@extends("layout.client.app")

@section("title", "Admin")

@section("head")
	@vite("resources/css/manage.css")
@endsection

@section("page", "Create Pegawai")

@section("head")
	@vite("resources/css/manage.css")
@endsection

@section("content")
	<!-- Error Message -->
	@if (session("error"))
		<div class="alert alert-danger" role="alert">
			{{ session("error") }}
		</div>
	@endif
	<form action="{{ route("data.store", $pegawai->id) }}" method="POST">
		@csrf
		@method("PUT")
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ $pegawai->name }}" required>
		</div>
		<div class="form-group">
			<label for="name">Nip:</label>
			<input type="text" class="form-control" id="nip" name="nip" value="{{ $pegawai->nip }}" required>
		</div>

		<div class="form-group">
			<label for="divisi">Divisi:</label>
			<select class="form-control" id="divisi" name="divisi">
				@foreach ($divisi as $d)
					<option value="{{ $d->id }}" {{ $pegawai->divisi->nama == $d->nama ? "selected" : "" }}>
						{{ $d->nama }}
					</option>
				@endforeach
			</select>
		</div>

		<button type="submit" class="btn btn-primary">Update</button>
	</form>
@endsection
