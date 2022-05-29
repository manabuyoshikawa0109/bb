@extends('admin.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/detail.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-sm-12 px-0">
    {{-- 要素を左右中央揃え --}}
    <div class="d-flex justify-content-center">
        <div class="x_panel px-1 px-sm-3 col-sm-6">
            <div class="x_title">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>大会詳細</h2>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">基本情報</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="identityList">
                                    <li class="clearfix">
                                        <div class="identityList__label" data-spec="crew_basic_name">
                                            氏名
                                        </div>
                                        <div class="identityList__value">吉川 学</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="identityList__label" data-spec="crew_basic_name">
                                            氏名（ヨミガナ）
                                        </div>
                                        <div class="identityList__value">ヨシカワ マナブ</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="identityList__label" data-spec="crew_basic_business_name">
                                            ビジネスネーム
                                        </div>
                                        <div class="identityList__value"></div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="identityList__label" data-spec="crew_basic_business_name">
                                            ビジネスネーム（ヨミガナ）
                                        </div>
                                        <div class="identityList__value"></div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="identityList__label" data-spec="crew_basic_birth_at">
                                            生年月日
                                        </div>
                                        <div class="identityList__value"><span data-eraconvert-era="平成06年01月09日" data-eraconvert-org="
                                            1994年01月09日
                                            " class="hanicaAnim highlighted--whiteback"><span>平成06年01月09日</span></span>
                                            （28）</div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="identityList__label" data-spec="crew_basic_gender">
                                                戸籍上の性別
                                            </div>
                                            <div class="identityList__value">男性</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="identityList">
                                        <li class="clearfix">
                                            <div class="identityList__label" data-spec="crew_basic_identity_card_img">
                                                本人確認書類1
                                            </div>
                                            <div class="identityList__value"><a title="運転免許証.jpeg" href="#" data-filetype="image" data-url="/crews/4bdc2a99-63b7-4b86-98ed-209d5e2ef3e0/files/identity_card_img1" data-target="#modal-previewFile_IdentityCardImg1_2d43d78d-c40d-46e0-9660-bf3707f2a5a6" data-toggle="modal" class="js-open-preview-file-modal">書類を確認する</a><div class="modal modal-previewFile fade" data-content-type="image/jpeg" id="modal-previewFile_IdentityCardImg1_2d43d78d-c40d-46e0-9660-bf3707f2a5a6" role="dialog" tabindex="-1">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body offset-0">
                                                            <img src="" title="本人確認書類1" alt="本人確認書類1" width="100%" height="auto">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="pull-left">
                                                                <a class="btn btn-link left-offset-0" target="_blank" href="/crews/4bdc2a99-63b7-4b86-98ed-209d5e2ef3e0/files/identity_card_img1" rel="noopener noreferrer"><i class="fa fa-external-link"></i>
                                                                    別ウィンドウで開く
                                                                </a></div>
                                                                <button class="btn btn-default" data-dismiss="modal" type="button">閉じる</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="identityList__label" data-spec="crew_basic_identity_card_img">
                                                本人確認書類2
                                            </div>
                                            <div class="identityList__value"></div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="identityList__label" data-spec="crew_basic_email">
                                                メールアドレス
                                            </div>
                                            <div class="identityList__value ellipsis" title="yoshikawa.manabu@joydea.jp">yoshikawa.manabu@joydea.jp</div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="identityList__label" data-spec="crew_my_number">
                                                マイナンバー
                                            </div>
                                            <div class="identityList__value"><a href="/crews/4bdc2a99-63b7-4b86-98ed-209d5e2ef3e0/my_number">※※※※※※※※</a></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="/crews/4bdc2a99-63b7-4b86-98ed-209d5e2ef3e0/crew_basic/timeline/histories"><i class="fa fa-fw fa-clock-o text-more-muted right-side"></i>
                                履歴一覧
                            </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
