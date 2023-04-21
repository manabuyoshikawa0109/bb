<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Event\Type;
use App\Enums\Event\ApplicableSex;

class Event extends Model
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
        'type'           => Type::class,
        'applicable_sex' => ApplicableSex::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
    ];

    /**
     * 参加費をフォーマットして返す
     *
     * @return string|null
     */
    public function formatEntryFee()
    {
        if ($this->entry_fee) {
            return number_format($this->entry_fee) . '円';
        }
        return null;
    }
}
