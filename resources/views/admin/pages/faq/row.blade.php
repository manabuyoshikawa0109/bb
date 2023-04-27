@php
$order = $loop->iteration ?? '@order@';
$key = $key ?? null;
@endphp
<div class="card accordion-item">
    <input type="hidden" name="ids[]" value="{{ $id ?? null }}">
    <h2 class="accordion-header" id="faq-accordion-heading{{ $order }}">
        <div class="accordion-button d-block d-sm-flex flex-row-reverse align-items-ceneter">
            <div class="d-flex align-items-center ms-sm-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-icon rounded-pill btn-outline-primary me-1"
                data-bs-toggle="collapse" data-bs-target="#faq-accordion{{ $order }}" aria-expanded="true" aria-controls="faq-accordion{{ $order }}"
                data-bs-html="true" data-bs-placement="top" title="このFAQの回答を<br>開く/閉じる">
                    <i class="bx bx-folder-open"></i>
                </button>
                <button type="button" class="btn btn-icon rounded-pill btn-outline-danger me-1 delete-faq"
                data-bs-html="true" data-bs-placement="top" title="このFAQを削除する">
                    <i class="bx bx-trash"></i>
                </button>
                <button type="button" class="btn btn-icon rounded-pill btn-outline-secondary me-1 up-faq"
                data-bs-html="true" data-bs-placement="top" title="このFAQの順番を<br>前にする">
                    <i class="bx bx-up-arrow-alt"></i>
                </button>
                <button type="button" class="btn btn-icon rounded-pill btn-outline-secondary down-faq"
                data-bs-html="true" data-bs-placement="top" title="このFAQの順番を<br>後ろにする">
                    <i class="bx bx-down-arrow-alt"></i>
                </button>
            </div>
            <div class="w-100">
                <div class="input-group">
                    <span class="input-group-text d-none d-sm-block">質問 {{ $order }}</span>
                    <textarea name="questions[]" class="form-control" placeholder="質問内容を入力" maxlength="100" rows="2">{{ $question ?? null }}</textarea>
                </div>
                @include('admin.commons.components.html.errors', ['fieldName' => "questions.{$key}"])
            </div>
        </div>
    </h2>
    {{-- エラー時showクラスを付与しアコーディオンを開いた状態とする --}}
    <div id="faq-accordion{{ $order }}" class="accordion-collapse collapse @if($errors->has("answers.{$key}")) show @endif" data-bs-parent="#faq-accordions">
        <div class="accordion-body">
            <div class="input-group">
                <span class="input-group-text d-none d-sm-block">回答 {{ $order }}</span>
                <textarea name="answers[]" class="form-control" placeholder="回答内容を入力" maxlength="500" rows="4">{{ $answer ?? null }}</textarea>
            </div>
            @include('admin.commons.components.html.errors', ['fieldName' => "answers.{$key}"])
        </div>
    </div>
</div>