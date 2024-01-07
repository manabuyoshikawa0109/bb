<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\SaveRequest;
use App\Http\Requests\Admin\Faq\SortRequest;
use Illuminate\Http\Request;
use App\Models\Faq;
use Throwable;
use Log;
use DB;

class FaqController extends Controller
{
    // 検索のセッションキー情報
    const SESSION_KEY_SEARCH        = 'admin.faq.search';
    const SESSION_KEY_SEARCH_PARAMS = 'admin.faq.search.params';
    const SESSION_KEY_SEARCH_PAGE   = 'admin.faq.search.page';

    /**
    * FAQ一覧
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
        $query = Faq::query();

        // キーワードで件名、本文を部分一致検索
        if($searchParam->keyword){
            $query->where(function ($query) use ($searchParam) {
                $query->where('faqs.question', 'like', "%{$searchParam->keyword}%")
                    ->orWhere('faqs.answer', 'like', "%{$searchParam->keyword}%");
            });
        }

        $faqs = $query->orderBy('order')->get();
        return view('admin.pages.faq.list', compact('faqs', 'searchParam'));
    }

    /**
    * FAQ並び替え
    * @param  SortRequest $request
    * @return \Illuminate\Http\Response
    */
    public function sort(SortRequest $request)
    {
        DB::beginTransaction();
        try {
            $ids = data_get($request->validated(), 'ids');
            foreach ($ids as $key => $id) {
                $order = $key + 1;
                $faq = Faq::findOrFail($id);
                $faq->order = $order;
                $faq->save();
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            abort(500);
        }

        // 完了メッセージをセット
        session()->flash('message', 'FAQの並び順を変更しました。');
        return redirect()->route('admin.faq.list');
    }

    /**
    * FAQ新規追加
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function add(Request $request)
    {
        $faq = new Faq();
        return view('admin.pages.faq.input', compact('faq'));
    }

    /**
    * FAQ新規登録
    * @param  SaveRequest $request
    * @return \Illuminate\Http\Response
    */
    public function create(SaveRequest $request)
    {
        $faq = new Faq();
        $faq->order = Faq::max('order') + 1;
        $faq->fill($request->validated())->save();

        // 完了メッセージをセット
        session()->flash('message', 'FAQを登録しました。');
        return redirect()->route('admin.faq.list');
    }

    /**
    * FAQ編集
    * @param  Request $request
    * @param  Faq $faq
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function edit(Request $request, Faq $faq)
    {
        return view('admin.pages.faq.input', compact('faq'));
    }

    /**
    * FAQ更新
    * @param  SaveRequest $request
    * @param  Faq $faq
    * @return \Illuminate\Http\Response
    */
    public function update(SaveRequest $request, Faq $faq)
    {
        $faq->fill($request->validated())->save();
        // 完了メッセージをセット
        session()->flash('message', 'FAQを更新しました。');
        return redirect()->route('admin.faq.list');
    }

    /**
    * FAQ削除
    * @param  Request $request
    * @param  Faq $faq
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Faq $faq)
    {
        $faq->delete();
        // 完了メッセージをセット
        session()->flash('message', 'FAQを削除しました。');
        return redirect()->route('admin.faq.list');
    }
}
