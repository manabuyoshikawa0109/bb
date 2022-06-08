<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">公開期間@required()</label>
    <div class="d-flex align-items-center">
        <div class="col px-0">
            @include('admin.commons.components.html.date', ['fieldName' => 'release_start_date', 'default' => optional($information->release_start_date)->format('Y-m-d')])
        </div>
        <span class="col-1 text-center px-0">〜</span>
        <div class="col px-0">
            @include('admin.commons.components.html.date', ['fieldName' => 'release_end_date', 'default' => optional($information->release_end_date)->format('Y-m-d')])
        </div>
    </div>
    <small class="text-muted">※公開開始日は必須です。公開終了日を入力しない場合、無期限で公開されます。</small>
</div>

<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">日付@required()</label>
    @include('admin.commons.components.html.date', ['fieldName' => 'date', 'default' => optional($information->date)->format('Y-m-d')])
</div>

<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">件名@required()</label>
    @include('admin.commons.components.html.text', ['fieldName' => 'subject', 'default' => $information->subject, 'placeholder' => '例】年末年始休業のお知らせ'])
</div>

<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">本文</label>
    @include('admin.commons.components.html.textarea', ['fieldName' => 'body', 'default' => $information->body, 'rows' => 10, 'placeholder' => '例】平素は格別のお引き立てを賜り、厚く御礼申し上げます。&#13;&#10;誠に勝手ながら、下記の期間を年末年始休業とさせていただきます。&#13;&#10;&#13;&#10;休業期間：2021年12月30日(木) より 2022年1月3日(月) まで'])
</div>
