@php
use Illuminate\Support\Str;
use App\Models\Faq;

// 行新規追加時に変数を渡さなくて良いよう2項演算子を使用
// 英数字ランダムの文字列は15文字でほぼ重複が発生しない
// 参考：https://qiita.com/daikikatsuragawa/items/27688f01c9c525a8af01
$order = $order ?? Str::random(15);
$faq = $faq ?? new Faq();
$id = old("ids.{$order}", $faq->id);
$question = old("questions.{$order}", $faq->question);
$answer = old("answers.{$order}", $faq->answer);
@endphp
<div class="accordion-item">
    <input type="hidden" name="ids[]" value="{{ $id }}">
    <h2 class="accordion-header" id="heading-{{ $order }}">
        {{-- 質問・回答どちらもバリデーションエラーでない場合、青い選択状態とならないようにする --}}
        <button class="accordion-button flex-wrap @if(!$errors->has("questions.{$order}") && !$errors->has("answers.{$order}")) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $order }}" aria-expanded="@if($errors->has("answers.{$order}")) true @else false @endif" aria-controls="collapse-{{ $order }}">
            <div class="col-12 d-flex align-items-center">
                <input type="text" class="form-control me-2" name="questions[]" value="{{ $question }}" maxlength="100" placeholder="質問内容を入力">
                <i class="lni lni-close"></i>
            </div>
            @include('admin.commons.components.html.errors', ['fieldName' => "questions.{$order}"])
        </button>
    </h2>
    <div id="collapse-{{ $order }}" class="accordion-collapse collapse @if($errors->has("answers.{$order}")) show @endif" aria-labelledby="heading-{{ $order }}" data-bs-parent="#faq-accordions">
        <div class="accordion-body">
            {{-- スマホ時はデバイス幅が狭く見づらい為6行表示にする --}}
            <textarea name="answers[]" class="form-control" placeholder="回答内容を入力" maxlength="500" rows="@if($agent->isMobile()) 6 @else 4 @endif">{{ $answer }}</textarea>
            @include('admin.commons.components.html.errors', ['fieldName' => "answers.{$order}"])
        </div>
    </div>
</div>