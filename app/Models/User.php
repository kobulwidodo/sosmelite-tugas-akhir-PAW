<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id');
    }

    public function gravatar($size = 100)
    {
        $default = "mm";
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=" . urlencode($default) . "&s=" . $size;
    }

    public function makeStatus($string)
    {
        $this->statuses()->create([
            'identifier' => Str::slug(Str::random(32) . $this->id),
            'body' => $string,
        ]);
    }

    public function makeReply($status_id, $body)
    {
        $this->replies()->create([
            'status_id' => $status_id,
            'comment' => $body,
        ]);
    }

    public function hasFollow(User $user)
    {
        return $this->follows()->whereFollowingUserId($user->id)->exists();
    }
}
