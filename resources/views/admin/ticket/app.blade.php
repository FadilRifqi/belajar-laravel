@extends("layout.client.app")

@section("title", "Admin")

@section("head")
	@vite("resources/css/manage.css")
@endsection

@section("page", "Manage Ticket")

@section("content")
	<div class="container mt-4">
		<h2>Tickets</h2>
		<div class="table-responsive">
			<table class="table ">
				<thead>
					<tr>
						<th scope="col" style="width: 5%" class="text-center">No</th>
						<th scope="col" style="width: 10%" class="text-center">Title</th>
						<th scope="col" style="width: 60%" class="text-start">Description</th>
						<th scope="col" style="width: 10%" class="text-center">Status</th>
						<th scope="col" style="width: 25%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tickets as $key => $ticket)
						<tr>
							<th scope="row" class="text-center">{{ $key + 1 }}</th>
							<td class="text-center">{{ $ticket->title }}</td>
							<td class="text-start">{{ $ticket->description }}</td>
							<td class="text-center">{{ $ticket->status->status_name }}</td>
							<td class="d-flex gap-1 justify-content-center flex-column flex-sm-row text-center">
								@if ($ticket->status_id == 1 || $ticket->status_id == 2)
									<form class="btn-responsive px-1" action="{{ route("ticket.solve", $ticket->id) }}" method="GET">
										<button type="submit" class="btn btn-warning">Solve</button>
									</form>
								@else
									<form class="btn-responsive px-1" action="{{ route("ticket.open", $ticket->id) }}" method="GET">
										<button type="submit" class="btn btn-info">Open</button>
									</form>
								@endif
								<form class="btn-responsive px-1" action="{{ route("ticket.delete", $ticket->id) }}" method="POST"
									style="display: inline-block;">
									@csrf
									@method("DELETE")
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- Pagination Links -->
		<div class="d-flex justify-content-center">
			{{ $tickets->links() }}
		</div>
	</div>
@endsection
