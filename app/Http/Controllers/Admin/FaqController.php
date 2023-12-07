<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveFaqRequest;
use Illuminate\Http\Request;
use App\Models\Faq;
use Throwable;
use Log;
use DB;

class FaqController extends Controller
{
    /**
    * よくある質問一覧
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function list(Request $request)
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.pages.faq.list', compact('faqs'));
    }

    /**
    * よくある質問保存
    * @param  SaveFaqRequest $request
    * @return \Illuminate\Http\Response
    */
    public function save(SaveFaqRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->validated();
            $ids = data_get($input, 'ids', []);
            $questions = data_get($input, 'questions');
            $answers = data_get($input, 'answers');
            $savedIds = [];
            foreach ($ids as $key => $id) {
                $order = $key + 1;
                $faq = Faq::findOrNew($id);
                $faq->question = $questions[$key];
                $faq->answer = $answers[$key];
                $faq->order = $order;
                $faq->save();

                // 登録・更新したIDを配列に格納
                array_push($savedIds, $faq->id);
            }

            // 登録・更新されなかったFAQは削除する
            Faq::whereNotIn('id', $savedIds)->delete();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            abort(500);
        }
        // 完了メッセージをセット
        session()->flash('message', 'FAQ情報を保存しました。');
        return redirect()->route('admin.faq.list');
    }
}
