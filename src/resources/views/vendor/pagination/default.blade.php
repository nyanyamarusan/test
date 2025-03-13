@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- 左矢印（前へ） --}}
        <li class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}">‹</a>
        </li>

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        <a href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- 右矢印（次へ） --}}
        <li class="{{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}">›</a>
        </li>
    </ul>
@endif
