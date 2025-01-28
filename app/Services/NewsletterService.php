<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Exceptions\SomethingWentWrongException;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactNotification;

class NewsletterService
{
    public static function storeFromRequest($request)
    {
        try {
            $data = [
                'EMail' => $request->email,
                'blob' => 'newsletters',
            ];
            $entity = Newsletter::withTrashed()->where('EMail', $request->email)->first();
            if ($entity) {
                $entity->restore();
                return Response::HTTP_CONFLICT;
            } else {
                $entity = new Newsletter($data);
                $entity->save();
                return Response::HTTP_OK;
            }
        } catch (\Exception $ex) {
                return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }

    public static function deleteFromRequest($request)
    {
        try {
            $entity = Newsletter::where('EMail', $request['email'])->first();
            if ($entity) {
                $entity->delete();
                return Response::HTTP_OK;
            } else {
                return Response::HTTP_NOT_FOUND;
            }
        } catch (\Exception $ex) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }
}
