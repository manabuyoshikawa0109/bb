<div class="mt-1">{{ '全 ' . number_format($paginator->total()) . ' 件中 ' . number_format($paginator->firstItem()) . ' ～ ' . number_format($paginator->lastItem()) . ' 件を表示' }}</div>
@if ($paginator->hasPages())
@php
$previousPageClass = null;
$previousPageUrl = $paginator->previousPageUrl();
if ($paginator->onFirstPage()) {
    $previousPageClass = 'disabled';
    $previousPageUrl = 'javascript:;';
}
$nextPageClass = 'disabled';
$nextPageUrl = 'javascript:;';
if ($paginator->hasMorePages()) {
    $nextPageClass = null;
    $nextPageUrl = $paginator->nextPageUrl();
}
@endphp
<nav class="mt-1">
    <ul class="pagination">
        {{-- 左矢印箇所 --}}
        {{-- 現在開いているページが1ページ目の場合は左矢印をクリックできない状態にする --}}
        <li class="page-item me-1 {{ $previousPageClass }}">
            <a class="page-link" href="{{ $previousPageUrl }}" aria-label="Previous">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        {{-- $elementsは2次元配列となっている為、ループ処理を行う --}}
        @foreach ($elements as $element)
            {{-- $elementが文字列の場合 --}}
            @if (is_string($element))
                <li class="page-item me-1 disabled">
                    <a class="page-link">{{ $element }}</a>
                </li>
            @endif

            {{--
                $elementが配列の場合
                $elementはキーにページ番号、値に現在のURL + ページ番号のパラメータを持つ配列となっている
            --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @php
                    $class = null;
                    // 現在開いているページの場合、アクティブ状態にしリンク遷移できない状態にする
                    if ($page == $paginator->currentPage()) {
                        $class = 'active';
                        $url = 'javascript:;';
                    }
                    @endphp
                    <li class="page-item me-1 {{ $class }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach
        {{-- 右矢印箇所 --}}
        {{-- 次のページが存在する場合、リンク遷移できる状態にする --}}
        <li class="page-item me-1 {{ $nextPageClass }}">
            <a class="page-link" href="{{ $nextPageUrl }}" aria-label="Next">
                <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul>
</nav>
@endif
