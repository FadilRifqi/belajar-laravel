@if ($paginator->hasPages())
	<nav aria-label="Page navigation" class="dark-theme font-weight-bold">
		<ul class="pagination pagination-sm m-0 float-right">
			{{-- First Page Link --}}
			@if (!$paginator->onFirstPage())
				<li class="page-item"><a href="{{ $paginator->url(1) }}" class="page-link" aria-label="First">&laquo;&laquo;</a></li>
			@endif

			{{-- Previous Page Link --}}
			@if ($paginator->onFirstPage())
				<li class="page-item disabled" aria-disabled="true"><span class="page-link" aria-hidden="true">&laquo;</span></li>
			@else
				<li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link"
						aria-label="Previous">&laquo;</a></li>
			@endif

			{{-- Pagination Elements --}}
			@foreach ($elements as $element)
				@if (is_string($element))
					<li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
				@endif

				@if (is_array($element))
					@foreach ($element as $page => $url)
						@if ($page == $paginator->currentPage())
							<li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
						@else
							<li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
						@endif
					@endforeach
				@endif
			@endforeach

			{{-- Next Page Link --}}
			@if ($paginator->hasMorePages())
				<li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="Next">&raquo;</a></li>
			@else
				<li class="page-item disabled" aria-disabled="true"><span class="page-link" aria-hidden="true">&raquo;</span></li>
			@endif

			{{-- Last Page Link --}}
			@if ($paginator->hasMorePages())
				<li class="page-item"><a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link"
						aria-label="Last">&raquo;&raquo;</a></li>
			@endif
		</ul>
	</nav>
@endif
