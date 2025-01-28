@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="pagination-filter" page='{{ $paginator->currentPage() - 1}}' href="{{ $paginator->previousPageUrl() }}" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if($page > $maxPage)
                                <?php continue ?>
                        @endif
                        @if ($page == $paginator->currentPage())
                            <li class="page-item">
                                <a class="active pagination-filter" href="{{ $url }}" page='{{ $page}}'>{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="pagination-filter" href="{{ $url }}" page='{{ $page}}'>{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages() && $paginator->currentPage() < $maxPage)
                <li class="page-item">
                    <a class="pagination-filter" href="{{ $paginator->nextPageUrl() }}" page='{{ $paginator->currentPage() + 1}}' aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
