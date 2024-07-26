<div>
	@section("title", auth()->user()->divisi->nama)

	@section("head")
		@vite("resources/js/app.js")
		<style>
			.chat-container {
				display: flex;
				flex-direction: column;
				height: 100vh;
				background-color: #f8f9fa;
			}

			.chat-header {
				padding: 15px;
				border-bottom: 1px solid #ddd;
				background-color: #f8f9fa;
				display: flex;
				justify-content: space-between;
				align-items: center;
			}

			.chat-messages {
				flex: 1;
				overflow-y: auto;
				padding: 15px;
				border-bottom: 1px solid #ddd;
				background-color: #e9ecef;
			}

			.chat-input {
				padding: 15px;
				background-color: #f8f9fa;
			}

			.message {
				margin-bottom: 10px;
				padding: 10px;
				border-radius: 5px;
				background-color: #ffffff;
				box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			}

			.message-right {
				text-align: right;
				background-color: #d1ecf1;
			}

			.message strong {
				display: block;
				margin-bottom: 5px;
			}
		</style>
	@endsection

	@section("page", "Chat")
	<div class="chat-container">
		<div class="chat-header">
			<h5>Chat</h5>
		</div>
		<div class="chat-messages">
			@foreach ($messages as $message)
				<div class="message {{ $message->user_id == auth()->user()->id ? "message-right" : "" }}">
					<strong>{{ $message->user_id == auth()->user()->id ? "" : $message->user->name . " :" }}</strong>
					{{ $message->body }}
				</div>
			@endforeach
		</div>
		<div class="chat-input">
			<div class="input-group">
				<input wire:model='body' type="text" class="form-control" placeholder="Type a message"
					onkeydown="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('sendButton').click(); }">
				<div class="input-group-append">
					<button id="sendButton" wire:click.prevent='makeNewMessage' class="btn btn-primary" type="submit"><i
							class="fas fa-paper-plane"></i> Send</button>
				</div>
			</div>
		</div>
	</div>
</div>
