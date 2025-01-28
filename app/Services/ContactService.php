<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Exceptions\SomethingWentWrongException;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactNotification;

class ContactService
{
    public static function storeFromRequest($request)
    {
        try {
            $data = [
                'Date' => now(),
                'Name' => $request->name,
                'EMail' => $request->email,
                'Phone' => $request->phone,
                'Message' => $request->message,
                'blob' => 'contacts',

            ];

            $entity = new Contact($data);
            $entity->save();
            return $entity;
        } catch (\Exception $ex) {
            return false;
        }

    }
    public static function updateFromRequest($entity, $request)
    {
        try {
            $data = [
                'Replay' => ($request->message),
                'IsReplayed' => 1,
            ];
            $entity->update($data);
            $entity->save();
            Notification::send((new User)->forceFill([
                'name' => $entity->Name,
                'email' => $entity->EMail,
            ]), new ContactNotification($entity));

        } catch (\Exception $ex) {
            throw new SomethingWentWrongException();
        }
        return $entity;
    }
}
