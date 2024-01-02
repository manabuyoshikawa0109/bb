<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveInformationRequest;
use Illuminate\Http\Request;
use App\Enums\ReleaseStatus;
use App\Models\Information;

class InformationController extends Controller
{
    // 検索のセッションキー情報
    const SESSION_KEY_SEARCH        = 'admin.information.search';
    const SESSION_KEY_SEARCH_PARAMS = 'admin.information.search.params';
    const SESSION_KEY_SEARCH_PAGE   = 'admin.information.search.page';
    /**
    * お知らせ一覧
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function list(Request $request)
    {
        if ($request->is_reset) {
            // 検索条件のリセット(検索条件・ページ数)
            session()->forget(self::SESSION_KEY_SEARCH);
        } elseif ($request->isMethod('post')) {
            // 検索実施時
            session()->put(self::SESSION_KEY_SEARCH_PARAMS, $request->all());
            session()->forget(self::SESSION_KEY_SEARCH_PAGE);
        } elseif ($request->page) {
            // GET送信でアクセス時
            session()->put(self::SESSION_KEY_SEARCH_PAGE, $request->page);
        }

        $page = session()->get(self::SESSION_KEY_SEARCH_PAGE, 1);
        $searchParams = session()->get(self::SESSION_KEY_SEARCH_PARAMS, []);

        // 変数を使用しやすいように配列からオブジェクトに変換
        $searchParam = changeArrayToObject($searchParams);

        // クエリ生成
        $query = Information::query();

        // キーワードで件名、本文を部分一致検索
        if($searchParam->keyword){
            $query->where(function ($query) use ($searchParam) {
                $query->where('information.subject', 'like', "%{$searchParam->keyword}%")
                    ->orWhere('information.body', 'like', "%{$searchParam->keyword}%");
            });
        }

        // 公開ステータスで検索
        // 公開ステータスに紐づくスコープ名で絞り込み
        $releaseStatus = ReleaseStatus::tryfrom($searchParam->release_status);
        if ($releaseStatus && $releaseStatus->scopeMethodName()){
            $query->{$releaseStatus->scopeMethodName()}();
        }

        // 更新日時の降順でソート
        $data = $query->orderByDesc('information.updated_at')->paginate(10, ['*'], 'page', $page);
        return view('admin.pages.information.list', compact('data', 'searchParam'));
    }

    /**
    * お知らせ新規追加
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function add(Request $request)
    {
        $information = new Information();
        return view('admin.pages.information.input', compact('information'));
    }

    /**
    * お知らせ新規登録
    * @param  SaveInformationRequest $request
    * @return \Illuminate\Http\Response
    */
    public function create(SaveInformationRequest $request)
    {
        $information = new Information();
        $information->fill($request->validated())->save();

        // 完了メッセージをセット
        session()->flash('message', 'お知らせを登録しました。');
        return redirect()->route('admin.information.list');
    }

    /**
    * お知らせ編集
    * @param  Request $request
    * @param  Information $information
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function edit(Request $request, Information $information)
    {
        return view('admin.pages.information.input', compact('information'));
    }

    /**
    * お知らせ更新
    * @param  SaveInformationRequest $request
    * @param  Information $information
    * @return \Illuminate\Http\Response
    */
    public function update(SaveInformationRequest $request, Information $information)
    {
        $information->fill($request->validated())->save();
        // 完了メッセージをセット
        session()->flash('message', 'お知らせを更新しました。');
        return redirect()->route('admin.information.list');
    }

    /**
    * お知らせ削除
    * @param  Request $request
    * @param  Information $information
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Information $information)
    {
        $information->delete();
        // 完了メッセージをセット
        session()->flash('message', 'お知らせを削除しました。');
        return redirect()->route('admin.information.list');
    }
}
