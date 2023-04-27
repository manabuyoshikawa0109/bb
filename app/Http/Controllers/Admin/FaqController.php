<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SaveFaqRequest;
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
            $order = 1;
            $ids = data_get($request->validated(), 'ids', []);
            $questions = data_get($request->validated(), 'questions');
            $answers = data_get($request->validated(), 'answers');
            $faqIds = [];
            foreach ($ids as $key => $id) {
                $faq = Faq::findOrNew($id);
                $faq->question = $questions[$key];
                $faq->answer = $answers[$key];
                $faq->order = $order;
                $faq->save();
                $faqIds[] = $faq->id;
                $order++;
            }
            Faq::whereNotIn('id', $faqIds)->delete();

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
