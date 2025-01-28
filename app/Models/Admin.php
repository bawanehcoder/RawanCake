<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\AuthorizeCheckTrait;
use App\Models\Traits\AvatarTrait;
use App\Models\Traits\FavoriteTrait;
use App\Models\Traits\HasMediaTrait;
use App\Models\Traits\PointTrait;
use App\Models\Traits\RatingTrait;
use App\Models\Traits\ToastNotificationTrait;
use App\Models\Traits\UserOccasionTrait;
use App\Models\Traits\VtechTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class Admin extends Authenticatable
{


    use HasApiTokens, HasFactory, Notifiable, AvatarTrait;
    use HasMediaTrait;
    use PointTrait;
    use FavoriteTrait;
    use UserOccasionTrait;
    use RatingTrait;
    use ToastNotificationTrait;
    use VtechTrait;
    use HasRoles;

    use AuthorizeCheckTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded='admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'remember_token',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'password' => 'hashed',
    ];

    public function notification()
    {

        return $this->hasMany(Notification::class, 'notifiable_id')->orderBy('created_at', 'desc');
    }
}
