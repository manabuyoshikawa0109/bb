<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'tournaments';

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
        list($startHour, $startMinutes) = explode(Event::HOUR_MINUTE_SEPARATOR, $this->start_time);
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
        list($startHour, $startMinutes) = explode(Event::HOUR_MINUTE_SEPARATOR, $this->start_time);
        return $startMinutes;
    }
}
