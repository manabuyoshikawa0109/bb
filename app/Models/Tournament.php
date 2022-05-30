<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ModelItems\Event\Type;
use App\ModelItems\Tournament\Status;
use Carbon\Carbon;

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
    * 大会が公開中か
    * @return boolean
    */
    public function isOpen()
    {
        return $this->status_id === Status::OPEN;
    }

    /**
    * 大会が非公開か
    * @return boolean
    */
    public function isClosed()
    {
        return $this->status_id === Status::CLOSED;
    }

    /**
    * 状態名を返す
    * @return string|null
    */
    public function statusName()
    {
        return Status::name($this->status_id);
    }

    /**
    * 開催日をフォーマットして返す
    * @param string format
    * @return string
    */
    public function formatDate(string $format = 'YYYY年M月D日(ddd)')
    {
        return (new Carbon($this->date))->isoFormat($format);
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
        $unit = '　';
        if($this->event) {
            $unit = Type::unit($this->event->type_id);
        }
        return $unit;
    }
}
