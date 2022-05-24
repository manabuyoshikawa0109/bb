@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/pagination.css?{{ now()->format('YmdHis') }}">
@endpush

<div class="paginator-wrap overflow-auto">
    <div class="form-inline">
        <span class="mr-2 ml-1">{{ '全 ' . number_format($paginator->total()) . ' 件中 ' . number_format($paginator->firstItem()) . ' ～ ' . number_format($paginator->lastItem()) . ' 件を表示' }}</span>
        @if ($paginator->hasPages())
        <ul class="pagination pagination-sm m-0">
            {{-- 左矢印箇所 --}}
            @if ($paginator->onFirstPage())
                {{-- 現在開いているページが1ページ目である場合は左矢印をクリックできない状態にする --}}
                <li class="page-item mr-1 disabled"><a class="page-link rounded border-0">«</a></li>
            @else
                <li class="page-item mr-1"><a class="page-link rounded border-0" href="{{ $paginator->previousPageUrl() }}">«</a></li>
            @endif

            {{-- $elementsは2次元配列、$elementは現在のURLにページ番号のパラメータがついたものが1次元配列の中に格納されている --}}
            @foreach ($elements as $element)
                {{-- $elementが文字列の場合 --}}
                @if (is_string($element))
                    <li class="page-item mr-1 disabled"><a class="page-link rounded border-0">{{ $element }}</a></li>
                @endif

                {{-- $elementが配列になっている場合 --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- 現在開いているページであればアクティブ状態にしリンクで遷移できない状態にする --}}
                        @if ($page == $paginator->currentPage())
                            <li class="page-item mr-1 active"><a class="page-link rounded border-0">{{ $page }}</a></li>
                        @else
                            <li class="page-item mr-1"><a class="page-link rounded border-0" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 右矢印箇所 --}}
            @if ($paginator->hasMorePages())
                {{-- 次のページが存在する場合、リンクで遷移できる状態にする --}}
                <li class="page-item mr-1"><a class="page-link rounded border-0" href="{{ $paginator->nextPageUrl() }}">»</a></li>
            @else
                <li class="page-item mr-1 disabled"><a class="page-link rounded border-0">»</a></li>
            @endif
        </ul>
        @endif
    </div>
</div>
