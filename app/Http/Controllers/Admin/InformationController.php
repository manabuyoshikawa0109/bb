<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterInformationRequest;
use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Arr;

class InformationController extends Controller
{
    // 検索系のセッション情報のキー
    const SESSION_KEY_SEARCH        = 'admin.informations.search';
    const SESSION_KEY_SEARCH_PARAMS = 'admin.informations.search.params';
    const SESSION_KEY_SEARCH_PAGE   = 'admin.informations.search.page';
    /**
    * お知らせ一覧
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function list(Request $request)
    {
        // TODO: 並び替え実装
        if ($request->reset) {
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

        $date = Arr::get($searchParams, 'date');
        $keyword = Arr::get($searchParams, 'keyword');
        $statusScope = Arr::get($searchParams, 'status_scope');

        $query = Information::query();

        // 日付で検索
        if($date !== null){
            $query->where('information.date', $date);
        }

        // キーワードで件名、本文検索
        if($keyword !== null){
            $query->where(function ($query) use ($keyword) {
                $query->where('information.subject', 'like', "%{$keyword}%")
                ->orWhere('information.body', 'like', "%{$keyword}%");
            });
        }

        // ステータスで検索
        if($statusScope !== null){
            $query->{ $statusScope }();
        }

        // 更新日時の降順
        $informations = $query->orderby('information.updated_at', 'desc')->paginate(10, ['*'], 'page', $page);
        return view('admin.pages.information.list', compact('informations', 'searchParams'));
    }

    /**
    * お知らせ新規追加
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function add(Request $request)
    {
        $information = new Information();
        return view('admin.pages.information.add', compact('information'));
    }

    /**
    * お知らせ新規登録
    * @param  RegisterInformationRequest $request
    * @return \Illuminate\Http\Response
    */
    public function create(RegisterInformationRequest $request)
    {
        $information = new Information();
        $information->fill($request->validated())->save();

        // 完了メッセージをセット
        session()->flash('message', 'お知らせを登録しました。');
        return redirect()->route('admin.information.detail', $information->id);
    }

    /**
    * お知らせ詳細
    * @param  Request $request
    * @param  Information $information
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function detail(Request $request, Information $information)
    {
        return view('admin.pages.information.detail', compact('information'));
    }

    /**
    * お知らせ編集
    * @param  Request $request
    * @param  Information $information
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function edit(Request $request, Information $information)
    {
        return view('admin.pages.information.edit', compact('information'));
    }

    /**
    * お知らせ更新
    * @param  RegisterInformationRequest $request
    * @param  Information $information
    * @return \Illuminate\Http\Response
    */
    public function update(RegisterInformationRequest $request, Information $information)
    {
        $information->fill($request->validated())->save();
        // 完了メッセージをセット
        session()->flash('message', 'お知らせを更新しました。');
        return redirect()->route('admin.information.detail', $information->id);
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
