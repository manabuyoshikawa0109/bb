<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveEventRequest;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
    * 種目一覧
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function list(Request $request)
    {
        // 更新日時の降順でソート
        $events = Event::orderByDesc('updated_at')->get();
        return view('admin.pages.event.list', compact('events'));
    }

    /**
    * 種目新規追加
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function add(Request $request)
    {
        $event = new Event();
        return view('admin.pages.event.input', compact('event'));
    }

    /**
    * 種目新規登録
    * @param  SaveEventRequest $request
    * @return \Illuminate\Http\Response
    */
    public function create(SaveEventRequest $request)
    {
        $event = new Event();
        $event->fill($request->validated())->save();

        // 完了メッセージをセット
        session()->flash('message', '種目情報を登録しました。');
        return redirect()->route('admin.event.list');
    }

    /**
    * 種目編集
    * @param  Request $request
    * @param  Event   $event
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function edit(Request $request, Event $event)
    {
        return view('admin.pages.event.input', compact('event'));
    }

    /**
    * 種目更新
    * @param  SaveEventRequest $request
    * @param  Event   $event
    * @return \Illuminate\Http\Response
    */
    public function update(SaveEventRequest $request, Event $event)
    {
        $event->fill($request->validated())->save();
        // 完了メッセージをセット
        session()->flash('message', '種目情報を更新しました。');
        return redirect()->route('admin.event.list');
    }

    /**
    * 種目削除
    * @param  Request $request
    * @param  Event   $event
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Event $event)
    {
        $event->delete();
        // 完了メッセージをセット
        session()->flash('message', '種目情報を削除しました。');
        return redirect()->route('admin.event.list');
    }
}
