@if ($paginator->hasPages())
    <div class="col-12">
        <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4 mt-md-8">
            <ul class="pagination gap-2 gap-md-3 justify-content-center align-items-center">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link rounded-circle transition d-center previous">
                            <i class="ph ph-caret-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link rounded-circle transition d-center previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                            <i class="ph ph-caret-left"></i>
                        </a>
                    </li>
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
                                <li class="page-item active">
                                    <span class="page-link rounded-circle transition d-center">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link rounded-circle transition d-center" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link rounded-circle transition d-center next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                            <i class="ph ph-caret-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link rounded-circle transition d-center next">
                            <i class="ph ph-caret-right"></i>
                        </span>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
@endif
