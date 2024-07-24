@extends("layout.client.app")

@section("title", "Admin")

@section("head")
	@vite("resources/css/manage.css")
@endsection

@section("page", "Manage Pegawai")

@section("head")
	@vite("resources/css/manage.css")
@endsection

@section("content")
	<div class="container mt-5">
		<!-- Export Button -->
		<button type="button" class="btn btn-dark text-white mb-1 ml-1" data-toggle="modal" data-target="#uploadExcelModal">Upload
			Data
		</button>
		<!-- Success Message -->
		@if (session("success"))
			<div class="alert alert-success" role="alert">
				{{ session("success") }}
			</div>
		@endif

		<!-- Error Message -->
		@if (session("error"))
			<div class="alert alert-danger" role="alert">
				{{ session("error") }}
			</div>
		@endif

		<div class="table-responsive">
			<!-- Search Form -->
			<form action="{{ route("manage-pegawai.search") }}" method="POST" class="mb-3">
				@csrf
				<div class="input-group">
					<input type="text" class="form-control" name="search" placeholder="Search by name or divisi"
						value="{{ old("search") }}">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit">Search</button>
					</div>
				</div>
			</form>
			<table class="table table-striped table-hover text-center">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Divisi</th>
						<th>Presensi</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@php
						$startingIndex = ($pegawai->currentPage() - 1) * $pegawai->perPage() + 1;
					@endphp
					<!-- Example row, you should replace this with your dynamic data -->
					@foreach ($pegawai as $key => $p)
						<tr>
							<td style="width: 5%">{{ $startingIndex + $key }}</td>
							<td style="width: 30%">{{ $p->name }}</td>
							<td style="width: 10%">{{ $p->divisi->nama }}</td>
							<td style="width: 30%">
								<button disabled
									class="status-responsive btn {{ $p->presensi->where("tanggal_presensi", now()->toDateString())->first() && $p->presensi->where("tanggal_presensi", now()->toDateString())->first()->presensi == true ? "btn-success" : "btn-danger" }} btn-sm mb-2 mb-sm-0 mr-sm-2">
									{{ $p->presensi->where("tanggal_presensi", now()->toDateString())->first() && $p->presensi->where("tanggal_presensi", now()->toDateString())->first()->presensi == true ? "Hadir" : "Tidak Hadir" }}
								</button>
							</td>
							<td style="width: 25% !important">
								<div class="d-flex gap-1 justify-content-center flex-column flex-sm-row">
									<form class="btn-responsive px-1" action="{{ route("data.edit", ["pegawai_id" => $p->id]) }}" method="GET">
										@csrf
										<button type="submit" style="width: 100%" class="btn btn-info btn-sm mb-2 mb-sm-0 mr-sm-2">Edit
										</button>
									</form>

									<form class="btn-responsive px-1" action="{{ route("data.hapus", ["pegawai_id" => $p->id]) }}" method="POST">
										@csrf
										@method("DELETE")
										<button type="submit" style="width: 100%" class="btn btn-danger btn-sm mb-2 mb-sm-0 mr-sm-2">
											Hapus
										</button>
									</form>

								</div>
							</td>
						</tr>
					@endforeach
					<!-- Add more rows as needed -->
				</tbody>
			</table>
		</div>
		<!-- Pagination Links -->
		<div class="d-flex justify-content-center">
			{{ $pegawai->links() }}
		</div>
		@include("admin.data.upload")
	</div>
@endsection
