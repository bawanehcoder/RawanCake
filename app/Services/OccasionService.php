<?php

namespace App\Services;

use App\Exceptions\SomethingWentWrongException;
use App\Jobs\OccasionJob;
use App\Models\Occasion;
use App\Models\User;
use Illuminate\Support\Carbon;

class OccasionService
{
    public static function storeFromRequest($request)
    {
        try {
            $data = [
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'date' => $request->date,
                'active' => 1,
                'blob' => $request->blob,
            ];

            $entity = new Occasion($data);
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
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'active' => $request->active_oc == null ? 0 : 1,
                'date' => $request->date,
            ];

            $entity->update($data);
            $entity->save();


        } catch (\Exception $ex) {

            throw new SomethingWentWrongException();
        }
        return $entity;

    }

    public static function sendMessage()
    {
        $occasions = Occasion::where('date', Carbon::now()->format('Y-m-d'))->get();
        if ($occasions->count() > 0) {
            foreach ($occasions as $occasion) {
                User::chunk(100, function ($data) use ($occasion) {
                    dispatch(new OccasionJob($data, $occasion));
                });
            }
        }
    }

}
