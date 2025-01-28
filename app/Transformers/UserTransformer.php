<?php

namespace App\Transformers;

use App\Models\Page;
use App\Models\User;
use App\Models\ZoneOption;
use App\Models\Zones;
use Carbon\Carbon;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
{
    protected $relations = ['zone'=>ZonesTransformer::class];
    protected $load = ['zone'=>ZonesTransformer::class];
    public function transform(User $user){

        return [
            'id' => (int) $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
            'SocialStatus' => $user->SocialStatus,
            'country_code' => $user->country_code !=null ? $user->country_code :'962',
            'phone' => $user->phone != null ? $user->phone :'787492261',
            'device_token' => $user->device_token,
            'birthDate' =>Carbon::parse($user->BirthDate)->format('Y-m-d'),

            'newsletter'=> $user->newsletter?true:false,
            'points'=>$user->totalPoints(),
            'points_money'=>$user->convertPointstoMoney($user->totalPoints()),
            'avatar' => [
                'small' => asset($user->avatar('small')),
                'medium' => asset($user->avatar('medium')),
                'large' => asset($user->avatar('large'))
            ],
        ];
    }
}
