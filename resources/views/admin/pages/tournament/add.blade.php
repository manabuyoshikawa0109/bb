@extends('admin.layouts.app')

@section('content')
<div class="col-sm-12 px-0">
    {{-- 要素を左右中央揃え --}}
    <div class="d-flex justify-content-center">
        <div class="x_panel px-1 px-sm-3 col-sm-6">
            <div class="x_title">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>大会新規登録</h2>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form action="{{ route('admin.tournament.create') }}" method="post">
                    @csrf

                    @include('admin.pages.tournament.components.input')

                    <div class="ln_solid"></div>
                    <div class="form-group mb-3 mb-sm-4">
                        <div class="text-center mt-4 mt-sm-0">
                            <a href="{{ route('admin.tournament.list') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-list mr-1"></i>一覧へ</a>
                            <button type="submit" class="btn btn-dark"><i class="fas fa-save mr-1"></i>登録する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function(){
    var attributes = [
        'capacity',
        'participation-fee',
        'start-hour',
        'start-minutes',
    ];

    $("#event-id").change(function() {
        for (attribute of attributes) {
            // data属性の値を取得
            var value = $(this).find('option:selected').attr('data-' + attribute);
            $('#' + attribute).val(value);
        }
    });
});
</script>
@endpush
