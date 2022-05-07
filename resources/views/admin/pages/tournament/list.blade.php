@extends('admin.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/table.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <div class="d-flex justify-content-between align-items-center">
                <h2>大会一覧</h2>
                <div class="d-block d-lg-none">
                    <a href="{{ route('admin.tournament.add') }}" class="btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>新規登録</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="{{ route('admin.tournament.list') }}" method="post">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div></div>
                    <div class="d-none d-lg-block">
                        <a href="{{ route('admin.tournament.add') }}" class="btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>新規登録</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="w-150-px">開催日時</th>
                                <th class="w-250-px">種目名</th>
                                <th class="w-250-px">場所</th>
                                <th class="w-100-px">募集数</th>
                                <th class="w-150-px">参加費</th>
                                <th class="w-100-px">公開／非公開</th>
                                <th class="w-100-px"></th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
