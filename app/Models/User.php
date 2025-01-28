<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\AuthorizeCheckTrait;
use App\Models\Traits\AvatarTrait;
use App\Models\Traits\FavoriteTrait;
use App\Models\Traits\HasMediaTrait;
use App\Models\Traits\PointTrait;
use App\Models\Traits\RatingTrait;
use App\Models\Traits\ReferralTrait;
use App\Models\Traits\ToastNotificationTrait;
use App\Models\Traits\UserOccasionTrait;
use App\Models\Traits\VtechTrait;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, Transformable
{
    use HasApiTokens, HasFactory, Notifiable, AvatarTrait;
    use HasApiTokens;
    use HasMediaTrait;
    use PointTrait;
    use FavoriteTrait;
    use UserOccasionTrait;
    use RatingTrait;
    use ToastNotificationTrait;
    use VtechTrait;
    use ReferralTrait;
    use HasRoles;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = 'user';
    protected $CollectionName = 'avatar';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'avatar',
        'password',
        'BirthDate',
        'LastSeenAt',
        'ZoneID',
        'LoginProvider',
        'ProviderID',
        'email_verified_at',
        'SocialStatus',
        'device_token',
        'CustomerID',
        'country_code'
    ];
    protected $dates = [

        'LastSeenAt',

    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'BirthDate' => 'date:m-d'
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

    public function getGenderAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'male';
            case 1:
                return 'female';

        }
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */


    public function isOnline()
    {
        if (!$this->LastSeenAt) {
            return false;
        }
        //60 * 1, //seconds
        return now()->diffInSeconds($this->LastSeenAt, true) < (int)60 * 1;
    }

    public function scopeOnlineLast24Hours($query)
    {
        return $query->where('LastSeenAt', '>=', now()->subDays(1));
    }

    public function UpdateLastSeen()
    {
        $this->LastSeenAt = Carbon::now();
        $this->save();
    }

    public function scopeOnline($query)
    {

        return $query->whereRaw(" abs( time_to_sec(timediff(LastSeenAt, now()) ) ) < 60 ");
    }

    public function scopeGenderMale($query)
    {

        return $query->where('gender', 0);
    }

    public function scopeGenderFemale($query)
    {

        return $query->where('gender', 1);
    }

    public function scopeLoggingFacebook($query)
    {
        return $query->where('LoginProvider', 'facebook');
    }

    public function scopeloggingGoogle($query)
    {
        return $query->where('LoginProvider', 'google');
    }

    public function scopeloggingSite($query)
    {
        return $query->whereNull('LoginProvider');
    }

    public function scopeSingle($query)
    {
        return $query->whereNull('SocialStatus');
    }

    public function scopeMarried($query)
    {
        return $query->where('SocialStatus', 1);
    }

    public function notify($instance)
    {
        app(Dispatcher::class)->send($this, $instance);

    }

    public function isEmailVerified()
    {
        return $this->email_verified_at;
    }

    public function transformer()
    {
        return UserTransformer::class;
    }

    public function zone()
    {
        return $this->hasOne(Zones::class, 'id', 'ZoneID');
    }

    public function hasRegisteredWithSocialId()
    {
        return !empty($this->ProviderID) && !empty($this->LoginProvider);
    }

    public function newsletter()
    {
        return $this->hasOne(Newsletter::class, 'EMail', 'email');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'UserID');
    }

    public function orderCount()
    {
        return $this->hasMany(Order::class, 'UserID')->count();
    }

    public function notification()
    {

        return $this->hasMany(Notification::class, 'notifiable_id')->where('type','!=','Filament\Notifications\DatabaseNotification')->orderBy('created_at', 'desc');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notifiable_id')->where('type','!=','Filament\Notifications\DatabaseNotification')->orderBy('created_at', 'desc');
    }

    public function userLogs()
    {
        return $this->hasMany(LogUser::class, 'UserID')->orderBy('id', 'DESC');
    }

    public function address(){
        return $this->hasMany(ShippingInfo::class, 'user_id');
    }
}
