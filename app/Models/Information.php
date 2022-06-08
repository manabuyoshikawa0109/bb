<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ModelItems\Information\Status;
use Carbon\Carbon;

class Information extends Model
{
    use HasFactory;

    /**
    * モデルに関連付けるテーブル
    *
    * @var string
    */
    protected $table = 'information';

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
    * キャストする必要のある属性
    *
    * @var array
    */
    protected $casts = [
        'release_start_date' => 'date',
        'release_end_date'   => 'date',
        'date'               => 'date',
    ];

    /**
    * 公開前のお知らせに限定するクエリスコープ
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeBeforeRelease($query)
    {
        $today = (Carbon::today())->format('Y-m-d');
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
        $today = (Carbon::today())->format('Y-m-d');
        return $query->where('information.release_start_date', '<=', $today)
        ->where(function ($query) use ($today) {
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
    public function scopeReleaseEnd($query)
    {
        $today = (Carbon::today())->format('Y-m-d');
        return $query->where('information.release_end_date', '<', $today);
    }

    /**
    * ステータス名を返す
    *
    * @return string
    */
    public function statusName()
    {
        $now = Carbon::now();
        // 今の日時 < 公開開始日
        if($now->lt($this->release_start_date)) {
            return Status::BEFORE_RELEASE;
        }
        // 公開終了日 < 今の日時
        if($this->release_end_date && $now->gt($this->release_end_date)) {
            return Status::RELEASE_END;
        }
        return Status::RELEASING;
    }

    /**
    * 色に関するクラス名を返す
    *
    * @return string
    */
    public function statusColorClass()
    {
        return Status::colorClass($this->statusName());
    }
}
