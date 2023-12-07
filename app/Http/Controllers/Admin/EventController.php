<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveEventRequest;
use Illuminate\Http\Request;
use App\Models\Event;
use Throwable;
use Log;
use DB;

class EventController extends Controller
{
    /**
    * 種目一覧
    * @param  Request $request
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function list(Request $request)
    {
        $events = Event::orderBy('id')->get()->toArray();
        return view('admin.pages.event.list', compact('events'));
    }

    /**
    * 種目保存
    * @param  SaveEventRequest $request
    * @return \Illuminate\Http\Response
    */
    public function save(SaveEventRequest $request)
    {
        DB::beginTransaction();
        try {
            $rows = data_get($request->validated(), "events");
            $savedIds = [];
            foreach ($rows as $row) {
                $event = Event::findOrNew(data_get($row, "id"));
                $event->name = data_get($row, "name");
                $event->type = data_get($row, "type");
                $event->capacity = data_get($row, "capacity");
                $event->participation_fee = data_get($row, "participation_fee");
                $event->start_time = data_get($row, "start_time");
                $event->save();

                // 登録・更新したIDを配列に格納
                array_push($savedIds, $event->id);
            }

            // 登録・更新されなかった種目は削除する
            Event::whereNotIn('id', $savedIds)->delete();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            abort(500);
        }
        // 完了メッセージをセット
        session()->flash('message', '種目情報を保存しました。');
        return redirect()->route('admin.event.list');
    }
}
