<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterTournamentRequest;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Event;
use App\Models\Place;
use Illuminate\Support\Arr;

class TournamentController extends Controller
{
    // 検索系のセッション情報のキー
    const SESSION_KEY_SEARCH        = 'admin.tournaments.search';
    const SESSION_KEY_SEARCH_PARAMS = 'admin.tournaments.search.params';
    const SESSION_KEY_SEARCH_PAGE   = 'admin.tournaments.search.page';
    /**
     * 大会情報一覧
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
        } elseif($request->page) {
            // GET送信でアクセス時
            session()->put(self::SESSION_KEY_SEARCH_PAGE, $request->page);
        }

        $page = session()->get(self::SESSION_KEY_SEARCH_PAGE, 1);
        $searchParams = session()->get(self::SESSION_KEY_SEARCH_PARAMS, []);

        $date = Arr::get($searchParams, 'date');
        $keyword = Arr::get($searchParams, 'keyword');
        $typeId = Arr::get($searchParams, 'type_id');

        $query = Tournament::query();

        // 開催日で検索
        if($date !== null){
            $query->where('tournaments.date', $date);
        }

        // キーワードで種目名、場所名検索
        if($keyword !== null){
            $query->where(function($query) use ($keyword) {
                $query->whereHas('event', function ($query) use ($keyword) {
                    $query->where('events.name', 'like', "%{$keyword}%");
                })->orWhereHas('place', function ($query) use ($keyword) {
                    $query->where('places.name', 'like', "%{$keyword}%");
                });
            });
        }

        // 種目IDで検索
        if($typeId !== null){
            $query->whereHas('event', function ($query) use ($typeId) {
                $query->where('events.type_id', $typeId);
            });
        }

        // 更新日時の降順
        $tournaments = $query->orderby('tournaments.updated_at', 'desc')->paginate(10, ['*'], 'page', $page);
        return view('admin.pages.tournament.list', compact('tournaments', 'searchParams'));
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
        $places = Place::all()->mapWithKeys(function ($place, $key) {
            return [$place->id => $place->name];
        });
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

    /**
     * 大会情報削除
     * @param  Request $request
     * @param  Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Tournament $tournament)
    {
        $tournament->delete();
        // 完了メッセージをセット
        session()->flash('message', '大会情報を削除しました。');
        return redirect()->route('admin.tournament.list');
    }
}
