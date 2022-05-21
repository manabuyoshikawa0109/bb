<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterTournamentRequest;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Event;
use App\Models\Place;

class TournamentController extends Controller
{
    /**
     * 大会情報一覧
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function list(Request $request)
    {
        // TODO: 検索・並び替え実装
        $tournaments = Tournament::paginate(10);
        return view('admin.pages.tournament.list', compact('tournaments'));
    }

    /**
     * 大会情報新規追加
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function add(Request $request)
    {
        $events = Event::all();
        $places = Place::all()->mapWithKeys(function ($place, $key) {
            return [$place->id => $place->name];
        });
        $tournament = new Tournament();
        return view('admin.pages.tournament.add', compact('tournament', 'events', 'places'));
    }

    /**
     * 大会情報新規登録
     * @param  RegisterTournamentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(RegisterTournamentRequest $request)
    {
        $input = $request->validated();
        $tournament = new Tournament();
        $tournament->start_time = "{$input['start_hour']}:{$input['start_minutes']}";
        $tournament->fill($input)->save();

        // 完了メッセージをセット
        session()->flash('message', '大会情報を登録しました。');
        return redirect()->route('admin.tournament.detail', $tournament->id);
    }

    /**
     * 大会情報詳細
     * @param  Request $request
     * @param  Tournament $tournament
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function detail(Request $request, Tournament $tournament)
    {
        return view('admin.pages.tournament.detail', compact('tournament'));
    }

    /**
     * 大会情報編集
     * @param  Request $request
     * @param  Tournament $tournament
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Request $request, Tournament $tournament)
    {
        $events = Event::all();
        $places = Place::all();
        return view('admin.pages.tournament.edit', compact('tournament', 'events', 'places'));
    }

    /**
     * 大会情報更新
     * @param  RegisterTournamentRequest $request
     * @param  Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterTournamentRequest $request, Tournament $tournament)
    {
        $input = $request->validated();
        $tournament->start_time = "{$input['start_hour']}:{$input['start_minutes']}";
        $tournament->fill($input)->save();
        // 完了メッセージをセット
        session()->flash('message', '大会情報を更新しました。');
        return redirect()->route('admin.tournament.detail', $tournament->id);
    }
}
