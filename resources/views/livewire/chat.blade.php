@section("title", auth()->user()->divisi->nama)

@section("head")
	@vite("resources/js/app.js")
	@vite("resources/js/chat.js")
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<style>
		.chat-container {
			display: flex;
			height: 100vh;
			background-color: #f8f9fa;
			position: relative;
		}

		.chat-sidebar {
			width: 25%;
			border-right: 1px solid #ddd;
			overflow-y: auto;
			background-color: #ffffff;
		}

		.chat-main {
			width: 75%;
			display: flex;
			flex-direction: column;
			background-color: #ffffff;
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
			border-top: 1px solid #ddd;
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

		.chat-header {
			background-color: #007bff;
			color: #fff;
		}

		.chat-list {
			padding: 0;
			margin: 0;
		}

		.chat-item {
			background-color: #fff;
			border: 1px solid #ddd;
			transition: background-color 0.3s;
		}

		.chat-item:hover {
			color: #343A40;
			background-color: #e9ecef;
		}

		.chat-avatar img {
			width: 40px;
			height: 40px;
		}

		.chat-info h6 {
			margin: 0;
		}

		.active-button {
			background-color: #e9ecef;
			color: #343A40;
		}

		.file-preview {
			position: absolute;
			bottom: 10%;
			width: 100%;
			background-color: #fff;
			padding: 10px;
			z-index: 10;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		}

		.file-preview-container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100px;
		}

		.file-preview-image {
			max-width: 150%;
			max-height: 100%;
			object-fit: contain;
		}

		.file-preview-container .close {
			cursor: pointer;
		}
	</style>
@endsection

@section("page", "Chat")

<div class="chat-container">
	@if ($file)
		<div class="file-preview">
			File Preview:
			@if (Str::startsWith($file->getMimeType(), "image/"))
				<div class="file-preview-container position-relative">
					<img src="{{ $file->temporaryUrl() }}" alt="Image preview" class="file-preview-image">
					<button type="button" class="close position-absolute btn-danger" aria-label="Close" wire:click='removeFile'
						style="top: 0; right: 0;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@else
				<div class="position-relative">
					<p>{{ $file->getClientOriginalName() }}</p>
					<button type="button" class="close position-absolute btn-danger" aria-label="Close" wire:click='removeFile'
						style="top: 0; right: 0;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif
		</div>
	@endif

	<div class="chat-sidebar">
		<div class="chat-header d-flex justify-content-between align-items-center p-3">
			<h5 class="mb-0">Chats</h5>
			<div class="dropdown">
				<button class="btn btn-primary btn-sm dropdown-toggle rounded-circle" type="button" id="dropdownMenuButton"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-plus"></i>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					@foreach ($users as $rekan)
						<a wire:click='createConversation({{ $rekan->id }})' class="dropdown-item">{{ $rekan->name }}</a>
					@endforeach
				</div>
			</div>
		</div>
		<div class="chat-list">
			@foreach ($conversation_users as $conversation_user)
				<button wire:click='changeConversation({{ $conversation_user->conversation->id }})'
					class="chat-item d-flex align-items-center p-3 mb-2 w-100 rounded {{ $conversation_active == $conversation_user->conversation->id ? "active-button" : "" }}">
					<div class="chat-avatar me-2">
						<img
							src="{{ !empty($conversation_user->user->avatar_url) ? $conversation_user->user->avatar_url : asset("assets/image/default_profile.png") }}"
							alt="User Avatar" class="img-fluid rounded-circle">
					</div>
					<div class="chat-info flex-grow-1">
						<h6 class="mb-0">
							@php
								$conversationName = $conversation_user->conversation->nama;
								if (strpos($conversationName, $user->name) !== false) {
								    $conversationName = str_replace([$user->name, "&"], "", $conversationName);
								    $conversationName = trim($conversationName);
								}
							@endphp
							{{ $conversationName }}
						</h6>
						<small class="text-muted">
							{{ $conversation_user->conversation->messages()->latest()->first() != null ? strftime("%A - %d - %H:%M", strtotime($conversation_user->conversation->messages()->latest()->first()->created_at)) : "" }}
						</small>
					</div>
				</button>
			@endforeach
		</div>
	</div>
	<div class="chat-main">
		<div class="chat-messages">
			@if ($conversation)
				@foreach ($messages as $message)
					<div class="message {{ $message->user_id == auth()->user()->id ? "message-right" : "" }}">
						<strong>{{ $message->user_id == auth()->user()->id ? "" : $message->user->name . " :" }}</strong>
						@php
							$fileExtension = pathinfo($message->file_path, PATHINFO_EXTENSION);
						@endphp

						@if (in_array(strtolower($fileExtension), $this->imageExtensions))
							<img src="{{ asset("storage/" . $message->file_path) }}" alt="Image" class="img-fluid"
								style="max-height: 300px;
    max-width: 40%;">
						@else
							<a href="{{ asset("storage/" . $message->file_path) }}" target="_blank">{{ basename($message->file_path) }}</a>
						@endif
						{{ $message->body }}
						<strong>{{ $message->user_id != auth()->user()->id ? "" : ": You" }}</strong>
					</div>
				@endforeach
			@else
				<div class="d-flex justify-content-center align-items-center vh-100">
					<div class="text-center">
						<h1 class="display-4 text-muted" style="opacity: 0.5;">
							Chat <i class="fas fa-comments"></i>
						</h1>
					</div>
				</div>
			@endif
		</div>
		<div class="chat-input p-3 bg-light border-top position-relative">
			<form wire:submit.prevent='makeNewMessage' id="chatForm" enctype="multipart/form-data">
				<div class="input-group">
					<label class="btn btn-secondary btn-sm mb-0 mr-2">
						<i class="fas fa-upload"></i>
						<input type="file" name="file" wire:model='file' class="d-none" id="fileUpload" onchange="previewFile()">
					</label>
					<input wire:model='body' type="text" class="form-control" placeholder="Type a message"
						onkeydown="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('sendButton').click(); }">
					<div class="input-group-append">
						<button id="sendButton" class="btn btn-primary" type="submit">
							<i class="fas fa-paper-plane"></i> Send
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
