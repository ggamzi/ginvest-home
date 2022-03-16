@if ($paginator->hasPages())

        <div class="paginate">
            {{-- Previous Page Link --}}
            @php
                $start_page = (ceil($paginator->currentPage()/10)-1)*10+1;
                $end_page = $start_page + 9 > $paginator->lastPage() ? $paginator->lastPage() : $start_page + 9;
            @endphp

            @if ($paginator->onFirstPage())
                {{-- 첫 페이지 일 때--}}
            @else
                @if($start_page-10 > 0)
                    <a href="{{ $paginator->url($start_page-10) }}" class="dir prev1" title="첫페이지"><span>‹‹</span></a>
                @endif
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="dir prev2" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                {{--
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif
                --}}

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if($page >= $start_page && $page <= $end_page)
                            @if ($page == $paginator->currentPage())
                                <a class="active" aria-current="page"><strong>{{ $page }}</strong></a>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="dir next1" aria-label="@lang('pagination.next')"><span>›</span></a>
                @if($start_page+10 < $paginator->lastPage())
                    <a href="{{ $paginator->url($start_page+10) }}" class="dir next2" title="마지막"><span>››</span></a>
                @endif
            @else
                {{-- 마지막 페이지 --}}
            @endif
        </div>
   
@endif
