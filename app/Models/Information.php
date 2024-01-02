<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ReleaseStatus;
use Carbon\Carbon;

class Information extends Model
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
    * キャストする必要のある属性
    *
    * @var array
    */
    protected $casts = [
        'release_start_date' => 'date',
        'release_end_date'   => 'date',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
    ];

    /**
    * 公開前のお知らせに限定するクエリスコープ
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeHasNotReleasedYet($query)
    {
        $today = Carbon::today()->format('Y-m-d');
        return $query->where('information.release_start_date', '>', $today);
    }

    /**
    * 公開中のお知らせに限定するクエリスコープ
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeReleasing($query)
    {
        $today = Carbon::today()->format('Y-m-d');
        return $query->where(function ($query) use ($today) {
            $query->whereNull('information.release_start_date')
            ->orWhere('information.release_start_date', '<=', $today);
        })->where(function ($query) use ($today) {
            $query->whereNull('information.release_end_date')
            ->orWhere('information.release_end_date', '>=', $today);
        });
    }

    /**
    * 公開終了のお知らせに限定するクエリスコープ
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeHasFinishedReleasing($query)
    {
        $today = (Carbon::today())->format('Y-m-d');
        return $query->where('information.release_end_date', '<', $today);
    }

    /**
    * ステータス値を返す
    *
    * @return int
    */
    public function status()
    {
        $now = Carbon::now();
        // 公開前(今の日時 < 公開開始日)
        if($this->release_start_date && $now->lt($this->release_start_date)) {
            return ReleaseStatus::HAS_NOT_RELEASED_YET->value;
        }
        // 公開終了(公開終了日 < 今の日時)
        if($this->release_end_date && $now->gt($this->release_end_date)) {
            return ReleaseStatus::HAS_FINISHED_RELEASING->value;
        }
        // 公開中
        return ReleaseStatus::RELEASING->value;
    }

    /**
    * ステータス名を返す
    *
    * @return string|null
    */
    public function statusName()
    {
        return ReleaseStatus::tryfrom($this->status())?->name();
    }

    /**
    * ステータスの色に関するクラス名を返す
    *
    * @return string|null
    */
    public function statusColorClass()
    {
        return ReleaseStatus::tryfrom($this->status())?->colorClass();
    }

    /**
    * 公開期間を返す
    *
    * @return string
    */
    public function releasePeriod()
    {
        if (!$this->release_start_date && !$this->release_end_date) {
            return '-';
        }
        // 片方どちらかがNULLの場合を考慮し、先頭と末尾の空白を除外
        return trim("{$this->release_start_date?->format('Y年n月j日')} 〜 {$this->release_end_date?->format('Y年n月j日')}");
    }
}
