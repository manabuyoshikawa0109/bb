{{--
    テーブルの初期設定コンポーネント（行追加・削除処理を含む）
    $newId : 追加する行の仮ID初期値
    $row : 追加する行のhtml（改行を除いた文字列）
--}}

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

function initIcheckBlue(){
    $('.icheck-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
}

function initIcheckRed(){
    $('.icheck-red').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
    });
}

$(function(){
    var newId = {{ $newId }};

    deleteRow();
    initIcheckBlue();
    initIcheckRed();

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
