@extends('admin.layouts.app')

@push('links')
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4 d-flex justify-content-between align-items-center">
    <div><span class="text-muted fw-light">大会管理 /</span> 一覧画面</div>
    <a href="{{ route('admin.tournament.add') }}" class="btn btn-primary"><i class="bx bxs-plus-circle me-1"></i>新規登録</a>
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>種目</th>
                    <th>日時<br>場所</th>
                    <th>公開期間</th>
                    <th>募集数 ／ 開催時間<br>参加費</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>
                        <span class="badge bg-label-{{ $event->type->colorClass() }}">{{ $event->type->name() }}</span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $event->applicable_sex->colorClass() }}">{{ $event->applicable_sex->name() }}</span>
                    </td>
                    <td>
                        {{ $event->formatApplicants("-{$event->type->unit()}") }} ／ {{ $event->held_time ?? '-' }}<br>{{ $event->formatEntryFee('-円') }}
                    </td>
                    <td>
                        <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-outline-success btn-icon me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="編集する">
                            <i class="bx bx-edit-alt"></i>
                        </a>
                        <form action="{{ route('admin.event.delete', $event->id) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-icon btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="削除する">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<a href="{{ route('admin.tournament.detail', $tournament->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="詳細"><i class="fas fa-file-alt"></i></a>
<a href="{{ route('admin.tournament.edit', $tournament->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="編集"><i class="fas fa-edit"></i></a>
<a href="{{ route('admin.tournament.delete', $tournament->id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="削除" onclick="return confirm('大会情報を削除しますか？')"><i class="fas fa-trash-alt"></i></a>
{{ $tournament->formatEntryFee() }}
{{ $tournament->formatApplicants() }}
{{ $tournaments->links('admin.commons.components.html.pagination') }}
isoFormat('YYYY年M月D日(ddd)
@endsection

{{-- 削除時確認ダイアログ表示 --}}
@include('admin.commons.components.js.delete_confirm', ['message' => '大会情報の削除\r\n削除後は復元することができませんがよろしいですか？'])

@push('scripts')
<script type="text/javascript">
$(function(){
});
</script>
@endpush
