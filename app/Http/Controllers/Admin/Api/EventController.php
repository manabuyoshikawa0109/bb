<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * 種目情報削除
     * @param  Request $request
     * @return
     */
    public function delete(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $event->delete();
    }
}
