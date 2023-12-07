<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Admin\Role;
use Storage;

class Admin extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'role'              => Role::class,
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
    ];

    /**
    * フルネームを返す
    * @return string
    */
    public function fullName()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    /**
    * 画像URLを返す
    * @return string
    */
    public function imageUrl()
    {
        $url = config('admin.admin.image.no_image_url');
        if ($this->image_path) {
            $storage = Storage::disk('public');
            $url = $storage->url($this->image_path);
            $timestamp = $storage->lastModified($this->image_path);
            $url = "{$url}?{$timestamp}";
        }
        return $url;
    }
}
