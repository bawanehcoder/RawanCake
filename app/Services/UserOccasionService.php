<?php

namespace App\Services;
use App\Jobs\OccasionJob;
use App\Jobs\UserOccasionJob;
use App\Models\Occasion;
use App\Models\User;
use App\Models\UserOccasion;
use Illuminate\Support\Carbon;

class UserOccasionService
{
    public static function storeFromRequest($request)
    {

        $data = [
            'title' => $request->title,
            'date' => $request->date,
            'Cat_id' => $request->category,
            'UserID' =>getLogged()->id ,
        ];
        $entity = new UserOccasion($data);
        $entity->save();
        if($request->category_image){
            $entity->clearMediaCollection('user_occasion');
        MediaService::addMediaFromRequest($entity, 'category_image', 'user_occasion');

        }

        return $entity;
    }
    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'title' => $request->title,
            'date' => $request->date,
            'Cat_id' => $request->category,
        ];
        $entity->update($data);
        $entity->save();
        if(!empty($request['category_image'])){
            $entity->clearMediaCollection('user_occasion');
            MediaService::addMediaFromRequest($entity, 'category_image', 'user_occasion');
        }
        return $entity;
    }
    public static function sendMessage()
    {
        $today=now();
        #Select today birthday users
        $occasions=UserOccasion::whereMonth('date',$today->month)->whereDay('date',$today->day+1)->chunk(100, function ($data)  {
              dispatch(new UserOccasionJob($data));
        });
    }
    public static function getImage(UserOccasion $item){

        if($item->getFirstMediaUrl('user_occasion','small')!='')  {
            $img=$item->getFirstMediaUrl('user_occasion','small');
        }else{
            $img=$item->categoriesOccasion->getFirstMediaUrl('categories_occasion','small');
        }
        return $img;
    }
}
