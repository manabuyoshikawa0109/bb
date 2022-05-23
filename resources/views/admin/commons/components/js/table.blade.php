{{--
    テーブルの初期設定コンポーネント（行追加・削除処理を含む）
    $newId : 追加する行の仮ID初期値
    $row : 追加する行のhtml（改行を除いた文字列）
--}}

{{-- iCheckの初期化 --}}
@include('admin.commons.components.js.icheck_blue')
@include('admin.commons.components.js.icheck_red')

@push('scripts')
<script type="text/javascript">
function hideTableHeader(){
    var count = $('#items').find('tr').length;
    if(count === 0){
        $('.headings, #form-submit-button-area').addClass('d-none');
    }
}

function deleteRow(){
    $('.fa-trash-alt').click(function() {
        $(this).closest('tr').remove();
        hideTableHeader();
    });
}
$(function(){
    var newId = {{ $newId }};

    $('[data-toggle="popover"]').popover();
    deleteRow();

    $('.add-row-btn').click(function() {
        $('.headings, #form-submit-button-area').removeClass('d-none');
        var row = '{!! $row !!}';
        row = row.replace(/@id@/g, newId);
        $('#items').append(row);
        deleteRow();
        initIcheckBlue();
        initIcheckRed();
        newId--;
        // initSortable();
    });

    // チェックボックス選択時に行の背景色を変えないようイベントをクリア
    $('table input').unbind('ifChecked').unbind('ifUnchecked');
});
</script>
@endpush
