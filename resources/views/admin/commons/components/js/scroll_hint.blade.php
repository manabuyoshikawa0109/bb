{{--
    スクロールヒントの初期化コンポーネント
    $class : 横スクロールする要素の親要素に付与されているクラス名
    $message : 表示するメッセージ
    参考:https://appleple.github.io/scroll-hint/
--}}
@push('links')
<link href="/assets/common/plugins/scroll-hint/css/scroll-hint.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="/assets/common/plugins/scroll-hint/js/scroll-hint.min.js"></script>
<script type="text/javascript">
$(function(){
    new ScrollHint("{{ $class ?? '.js-scrollable' }}", {
        i18n: {
            scrollable: "{{ $message ?? 'スクロールできます' }}"
        }
    });
});
</script>
@endpush