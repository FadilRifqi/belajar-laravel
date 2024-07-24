@if ($paginator->hasPages())
	<ul class="pagination pagination-sm m-0 float-right">
		{{-- Previous Page Link --}}
		@if ($paginator->onFirstPage())
			<li class="page-item disabled"><span class="page-link">«</span></li>
		@else
			<li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link">«</a></li>
		@endif

		{{-- Pagination Elements --}}
		@foreach ($elements as $element)
			{{-- "Three Dots" Separator --}}
			@if (is_string($element))
				<li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
			@endif

			{{-- Array Of Links --}}
			@if (is_array($element))
				@foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<li class="page-item active"><span class="page-link">{{ $page }}</span></li>
					@else
						<li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
					@endif
				@endforeach
			@endif
		@endforeach

		{{-- Next Page Link --}}
		@if ($paginator->hasMorePages())
			<li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link">»</a></li>
		@else
			<li class="page-item disabled"><span class="page-link">»</span></li>
		@endif
	</ul>
@endif
