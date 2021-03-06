<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * 種目入力
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function input(Request $request)
    {
        if(old('events')){
            $newId = min(array_keys(old('events'))) -1;
            $events = collect();
            foreach (old('events') as $id => $input) {
               $event = new Event($input);
               $event->id = $id;
               $events->push($event);
            }
        }else{
            $newId = -1;
            $events = Event::all();
        }
        $eventInstance = new Event();
        return view('admin.pages.event.input', compact('events', 'eventInstance', 'newId'));
    }

    /**
     * 種目登録
     * @param  RegisterEventRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterEventRequest $request)
    {
        $inputs = Arr::get($request->validated(), 'events');
        foreach ($inputs as $id => $input) {
            $event = Event::firstOrNew(['id' => $id]);
            if(isset($input['delete']) && $input['delete'] === '1'){
                $event->delete();
                continue;
            }

            $event->fill($input);
            $event->start_time = null;
            if(isset($input['start_hour']) && isset($input['start_minutes'])){
                $event->start_time = "{$input['start_hour']}:{$input['start_minutes']}";
            }
            $event->save();
        }
        // 完了メッセージをセット
        session()->flash('message', '種目情報を保存しました。');
        return redirect()->route('admin.event.input');
    }
}
