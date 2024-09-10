@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item" aria-disabled="true">
                    <button disabled class="btn btn-sm btn-outline-dark btn-icon rounded-circle">
                        {!! __('pagination.previous') !!}
                    </button>
                </li>
            @else
                <li class="page-item">
                    <a class="btn btn-sm btn-outline-dark btn-icon rounded-circle" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        {!! __('pagination.previous') !!}
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="btn btn-sm btn-outline-dark btn-icon rounded-circle" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        {!! __('pagination.next') !!}
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <button disabled class="btn btn-sm btn-outline-dark btn-icon rounded-circle">
                        {!! __('pagination.next') !!}
                    </button>
                </li>
            @endif

        </ul>
    </nav>
@endif
