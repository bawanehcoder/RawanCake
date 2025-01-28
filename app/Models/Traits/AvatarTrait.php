<?php

namespace App\Models\Traits;

use App\Services\MediaService;

trait AvatarTrait
{
    public function addAvatarFromUrl($url){
        $media= MediaService::addMediaFromUrl($this, $url, $collection = 'avatar', $this);
        $this->avatar = $media->getFullUrl('small');
        $this->save();
    }
    public function avatar()
    {
        return $this->avatar;
    }
    public function getAvatarAttribute($value)
    {
        return !empty($value) ? $value : '/assets/img/user.svg';
    }
    public function hasAvatar()
    {
        return !empty($this->getRawOriginal('avatar'));
    }
}
