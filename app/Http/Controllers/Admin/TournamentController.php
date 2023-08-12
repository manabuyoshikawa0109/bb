<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveTournamentRequest;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Event;
use App\Models\Place;
use App\Enums\Status;

class TournamentController extends Controller
{
    // 検索系のセッション情報のキー
    const SESSION_KEY_SEARCH            = 'admin.tournaments.search';
    const SESSION_KEY_SEARCH_PARAMETERS = 'admin.tournaments.search.parameters';
    const SESSION_KEY_SEARCH_PAGE       = 'admin.tournaments.search.page';
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
            session()->put(self::SESSION_KEY_SEARCH_PARAMETERS, $request->all());
            session()->forget(self::SESSION_KEY_SEARCH_PAGE);
        } elseif ($request->page) {
            // GET送信でアクセス時
            session()->put(self::SESSION_KEY_SEARCH_PAGE, $request->page);
        }

        $page = session()->get(self::SESSION_KEY_SEARCH_PAGE, 1);
        $searchParameters = session()->get(self::SESSION_KEY_SEARCH_PARAMETERS, []);

        $query = Tournament::query();

        // 公開前、公開中、公開終了で検索
        $statusId = data_get($searchParameters, 'status_id');
        if ($statusId == Status::HAS_NOT_RELEASED_YET->value) {
            $query->hasNotReleasedYet();
        } else if ($statusId == Status::RELEASING->value) {
            $query->releasing();
        } else if ($statusId == Status::HAS_FINISHED_RELEASING->value) {
            $query->hasFinishedReleasing();
        }

        // 開催日で検索
        if ($heldDate = data_get($searchParameters, 'held_date')) {
            $query->whereDate('held_at', $heldDate);
        }

        // 種目で検索
        if ($eventId = data_get($searchParameters, 'event_id')) {
            $query->where('event_id', $eventId);
        }

        // 場所で検索
        if ($placeId = data_get($searchParameters, 'place_id')) {
            $query->where('place_id', $placeId);
        }

        // 開催日時の降順
        $tournaments = $query->latest('held_at')->paginate(10, ['*'], 'page', $page);
        return view('admin.pages.tournament.list', compact('tournaments', 'searchParameters'));
    }

    /**
     * 大会情報新規追加
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function add(Request $request)
    {
        $events = Event::all();
        $places = Place::all();
        $tournament = new Tournament();
        return view('admin.pages.tournament.input', compact('tournament', 'events', 'places'));
    }

    /**
     * 大会情報新規登録
     * @param  SaveTournamentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(SaveTournamentRequest $request)
    {
        $tournament = new Tournament();
        $tournament->fill($request->validated())->save();

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
        return view('admin.pages.tournament.input', compact('tournament', 'events', 'places'));
    }

    /**
     * 大会情報更新
     * @param  SaveTournamentRequest $request
     * @param  Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(SaveTournamentRequest $request, Tournament $tournament)
    {
        $tournament->fill($request->validated())->save();
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
