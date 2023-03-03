<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tournament extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'release_start_date' => 'date',
        'release_end_date'   => 'date',
        'held_at'            => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
    ];

    /**
    * 種目マスタ
    */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
    * 場所マスタ
    */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /**
    * 公開前の大会に限定するクエリスコープ
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeHasNotReleasedYet($query)
    {
        $today = (Carbon::today())->format('Y-m-d');
        return $query->where('tournaments.release_start_date', '>', $today);
    }

    /**
    * 公開中の大会に限定するクエリスコープ
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeReleasing($query)
    {
        $today = (Carbon::today())->format('Y-m-d');
        return $query->where(function ($query) use ($today) {
            $query->whereNull('tournaments.release_start_date')
            ->orWhere('tournaments.release_start_date', '<=', $today);
        })->where(function ($query) use ($today) {
            $query->whereNull('tournaments.release_end_date')
            ->orWhere('tournaments.release_end_date', '>=', $today);
        });
    }

    /**
    * 公開終了の大会に限定するクエリスコープ
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeHasFinishedReleasing($query)
    {
        $today = (Carbon::today())->format('Y-m-d');
        return $query->where('tournaments.release_end_date', '<', $today);
    }

    /**
    * 参加費をフォーマットして返す
    * @return string
    */
    public function formatEntryFee()
    {
        return number_format($this->entry_fee) . '円';
    }

    /**
    * 募集数をフォーマットして返す
    * @return string
    */
    public function formatApplicants()
    {
        return number_format($this->applicants) . $this->applicantsUnit();
    }

    /**
    * 募集数の単位を返す
    * @return string|null
    */
    public function applicantsUnit()
    {
        return $this->event->type->unit() ?? null;
    }
}
