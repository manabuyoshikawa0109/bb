<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * 時間と分の区切り文字
     */
    const HOUR_MINUTES_SEPARATOR = ':';

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'events';

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
    * 開始時間を取得
    * @return string|null
    */
    public function getStartHourAttribute()
    {
        if($this->start_time === null){
            return null;
        }
        list($startHour, $startMinutes) = explode(self::HOUR_MINUTES_SEPARATOR, $this->start_time);
        return $startHour;
    }

    /**
    * 開始分を取得
    * @return string|null
    */
    public function getStartMinutesAttribute()
    {
        if($this->start_time === null){
            return null;
        }
        list($startHour, $startMinutes) = explode(self::HOUR_MINUTES_SEPARATOR, $this->start_time);
        return $startMinutes;
    }
}
