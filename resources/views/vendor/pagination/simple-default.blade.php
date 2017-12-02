@if ($paginator->hasPages())
    <nav aria-label="...">
    <ul class="pager">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <a href="#"><span>@lang('pagination.previous')</span></a>
            </li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="disabled">
                <a href="#">
                    <span>@lang('pagination.next')</span>
                </a>
            </li>
        @endif
    </ul>
    </nav>
@endif
