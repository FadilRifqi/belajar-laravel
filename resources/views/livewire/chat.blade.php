<div>
	@section("title", auth()->user()->divisi->nama)

	@section("head")
		@vite("resources/js/app.js")
	@endsection

	@section("page", "Chat")

	<div>
		<input type="text" wire:model='message'>
		<button wire:click.prevent='makeNewMessage'>{{ $message }}</button>
	</div>
</div>
