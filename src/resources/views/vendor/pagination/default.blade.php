@if ($paginator->hasPages())
    <nav class="pagination">

        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
            <span class="pagination__item disabled">&lt;</span>
        @else
            <a class="pagination__item" href="{{ $paginator->previousPageUrl() }}">&lt;</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)

            {{-- ... --}}
            @if (is_string($element))
                <span class="pagination__item disabled">{{ $element }}</span>
            @endif

            {{-- 数字 --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination__item active">{{ $page }}</span>
                    @else
                        <a class="pagination__item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
            <a class="pagination__item" href="{{ $paginator->nextPageUrl() }}">&gt;</a>
        @else
            <span class="pagination__item disabled">&gt;</span>
        @endif

    </nav>
@endif