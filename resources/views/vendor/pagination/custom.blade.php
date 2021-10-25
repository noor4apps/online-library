@if ($paginator->hasPages())
    <ul class="wn__pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <a aria-hidden="true">&lsaquo;</a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a>{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a>{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}"><i class="zmdi zmdi-chevron-right"></i></a></li>
            @else
                <li>
                    <a aria-hidden="true">&rsaquo;</a>
                </li>
            @endif
        </ul>
@endif
