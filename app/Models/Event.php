<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ModelItems\Event\Type;

class Event extends Model
{
    use HasFactory;

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
        list($startHour, $startMinutes) = explode(':', $this->start_time);
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
        list($startHour, $startMinutes) = explode(':', $this->start_time);
        return $startMinutes;
    }

    /**
    * 種別名を返す
    * @return string
    */
    public function typeName()
    {
        return Type::name($this->type_id);
    }

    /**
    * 種別毎の色に関するクラス名を返す
    * @return string
    */
    public function typeColorClass()
    {
        return Type::colorClass($this->type_id);
    }
}
