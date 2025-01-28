<?php

namespace App\Services;

use App\Exceptions\OldNewPasswordMismatchException;
use App\Models\LogUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function changePassword($user, $oldPassword, $newPassword)
    {

        if (!empty($user->password) && !\Hash::check($oldPassword, $user->password)) {
            throw new OldNewPasswordMismatchException();
        }
        $user->password = Hash::make($newPassword);
        $user->save();
    }

    public static function updateAvatarFromRequest($user, $request)
    {
        $media = MediaService::addMediaFromRequest(getLogged(), 'file', $collection = 'avatar');
        $user->avatar = $media->getFullUrl('small');
        $user->save();
    }

    public static function updateFromRequest($user, $request)
    {
        $data = [];
        if (isset($request->name) && !empty($request->name)) {
            $data['name'] = $request->name;
        }
        if (isset($request->gender) ) {
            $data['gender'] = $request->gender;
        }

        if (isset($request->country_code) ) {
            $data['country_code'] = $request->country_code;
        }

        if (isset($request->phone) && !empty($request->phone)) {
            $data['phone'] = $request->phone;
        }

        if (isset($request->socialStatus) && !empty($request->socialStatus)) {
            $data['SocialStatus'] = $request->socialStatus;
        }
//        if (isset($request->marriageDate) && !empty($request->marriageDate)) {
//            $data['MarriageDate'] = $request->marriageDate;
//        }
//        if (isset($request->partnerBirthdate) && !empty($request->partnerBirthdate)) {
//            $data['PartnerBirthdate'] = $request->partnerBirthdate;
//        }
        if (isset($request->zone) && !empty($request->zone)) {
            $data['ZoneID'] = $request->zone;
        }
        $user->update($data);
        $user->save();
    }

    public static function getAllUsers()
    {
        $users = User::query();
        return $users->get();
    }

    public static function logUser($user_id, $source, $data)
    {

        $data = [
            'source' => $source,
            'data' => $data??'',
            'UserID' => $user_id
        ];
        $log_user = new LogUser($data);
        $log_user->save();
    }
}
