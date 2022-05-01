@extends('admin.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/event.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <div class="d-flex justify-content-between align-items-center">
                <h2>種目マスタ</h2>
                <div class="d-block d-lg-none">
                    <button type="button" class="add-row-btn btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>行を追加</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="{{ route('admin.event.register') }}" method="post">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div>種目名・削除以外の項目は<code>「大会管理 > 新規登録」</code>で種目選択時にデフォルトで反映される設定値です。</div>
                    <div class="d-none d-lg-block">
                        <button type="button" class="add-row-btn btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>行を追加</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings @if($events->isEmpty()) d-none @endif">
                                <th class="w-250-px">種目名<span class="badge badge-danger ml-1">必須</span></th>
                                <th class="w-100-px">募集数</th>
                                <th class="w-150-px">参加費</th>
                                <th class="w-150-px">開始時間</th>
                                <th class="w-100-px">ダブルス</th>
                                <th class="w-100-px">ミックス</th>
                                <th class="w-100-px">削除</th>
                            </tr>
                        </thead>

                        <tbody id="events">
                            @foreach ($events as $event)
                                @include('admin.pages.event.row', ['event' => $event ])
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="form-submit-button-area" class="col-12 text-center @if($events->isEmpty()) d-none @endif">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-save mr-1"></i>登録する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@php
$row = view('admin.pages.event.row', ['event' => $eventInstance ])->render();
// 改行を全て取り除く
$row = str_replace(array("\r\n", "\r", "\n"), '', $row);
@endphp

@push('scripts')
<script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script type="text/javascript">
function hideTableHeader(){
    var count = $('#events').find('tr').length;
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
        $('#events').append(row);
        deleteRow();
        initIcheckBlue();
        initIcheckRed();
        newId--;
        // initSortable();
    });

    // チェックボックス選択時に行の背景色を変えないようイベントをクリア
    $('table input').unbind('ifChecked').unbind('ifUnchecked');

{{--
    // 非同期削除
    // 参考：https://qiita.com/u-dai/items/d43e932cd6d96c09b69a
    $('.ajax-delete').click(function() {
        Swal.fire({
            title: '削除しますか？',
            text: "保存されている種目情報を削除します。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '削除する',
            cancelButtonText: 'キャンセル',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : 'POST',
                    url  : '{{ route('admin.api.event.delete') }}',
                    // attrでhtmlのカスタムデータ属性から直接取得(jsのキャッシュから取得しない)
                    // 参考：https://qiita.com/Kta-M/items/2eda39750abd10df9801
                    data : {
                        'id' : $(this).attr('data-id'),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // csrfトークンの追加
                    }
                })
                .done(function () {
                    // 成功した場合の処理
                    $(this).closest('tr').remove();
                    hideTableHeader();
                    Swal.fire({
                        icon: 'success',
                        title: '種目情報を削除しました。',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                })
                .fail(function () {
                    // エラーの場合の処理
                    Swal.fire({
                        icon: 'error',
                        title: 'エラーが発生しました。',
                        text: 'しばらく経ってから再度お試しください。',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                })
            }
        })
    });
--}}
});
</script>
@endpush
