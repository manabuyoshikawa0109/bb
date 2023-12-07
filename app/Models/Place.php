<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Place extends Model
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
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
    ];

    /**
    * 画像URLを返す
    * @return string
    */
    public function imageUrl()
    {
        $url = config('admin.place.image.no_image_url');
        if ($this->image_path) {
            $storage = Storage::disk('public');
            $url = $storage->url($this->image_path);
            $timestamp = $storage->lastModified($this->image_path);
            $url = "{$url}?{$timestamp}";
        }
        return $url;
    }

    /**
    * 画像ファイル名を返す
    * @return string|null
    */
    public function imageFileName()
    {
        if ($this->image_path) {
            return basename($this->image_path);
        }
        return null;
    }
}
