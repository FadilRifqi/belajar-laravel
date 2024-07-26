<div>
	@section("title", auth()->user()->divisi->nama)

	@section("head")

	@endsection

	@section("page", "Chat")

	@section("content")
		<p>{{ $message }}</p>
	@endsection
</div>
