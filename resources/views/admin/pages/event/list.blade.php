@extends('admin.layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4 d-flex justify-content-between align-items-center">
    <div><span class="text-muted fw-light">種目マスタ /</span> 一覧画面</div>
    <a href="{{ route('admin.event.add') }}" class="btn btn-primary"><i class="bx bxs-plus-circle me-1"></i>新規登録</a>
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>種目名</th>
                    <th>種別</th>
                    <th>申し込み<br>可能な性別</th>
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
                        {{ $event->applicants ?? '' }}{{ $event->type->unit() }} ／ {{ $event->held_time ?? '-' }}<br>{{ $event->formatEntryFee() ?? '-円' }}
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
<!--/ Basic Bootstrap Table -->
@endsection

{{-- 削除時確認ダイアログ表示 --}}
@include('admin.commons.components.js.delete_confirm', ['message' => '種目情報の削除\r\n削除後は復元することができませんがよろしいですか？'])
