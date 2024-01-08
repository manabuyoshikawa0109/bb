@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">お知らせ管理</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.home.index') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">お知らせ一覧</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.information.list') }}" method="post">
            @csrf
            {{-- 公開ステータス絞り込みボタン --}}
            @include('admin.commons.components.html.release_status', ['searchParam' => $searchParam])
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    @include('admin.commons.components.html.text', [
                        'fieldName' => 'keyword',
                        'class' => 'ps-5 radius-30',
                        'default' => $searchParam->keyword,
                        'placeholder' => 'フリーワード検索',
                    ])
                    <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                </div>
                <div class="ms-auto"><a href="{{ route('admin.information.add') }}" class="btn btn-dark radius-30 mt-2 mt-lg-0"><i class="bx bx-plus-circle"></i>新規登録</a></div>
            </div>
        </form>
        <div class="table-responsive js-scrollable">
            <table class="table table-layout-fixed mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 250px;">件名</th>
                        <th style="width: 120px;">ステータス</th>
                        <th style="width: 300px;">公開期間</th>
                        <th style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $information)
                    <tr>
                        <td class="text-truncate">{{ $information->subject }}</td>
                        <td>
                            <div class="badge rounded-pill bg-outline-{{ $information->statusColorClass() }} p-2 px-3">
                                <i class="bx bxs-circle me-1"></i>{{ $information->statusName() }}
                            </div>
                        </td>
                        <td>{{ $information->releasePeriod() }}</td>
                        <td>
                            <div class="d-flex order-actions">
                                <a href="{{ route('admin.information.edit', $information->id) }}"><i class="bx bxs-edit"></i></a>
                                <a href="{{ route('admin.information.delete', $information->id) }}" class="ms-3" onclick="return confirm('お知らせを削除しますか？')"><i class="bx bxs-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links('admin.commons.components.html.pagination') }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function(){
    // フリーワード入力時即時検索実行
    $('input[name="keyword"]').keyup(function (e) {
        $(this).closest('form').submit();
    });
});
</script>
@endpush
