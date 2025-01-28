<?php

namespace App\Transformers;

use App\Models\Page;
use App\Models\ZoneOption;
use App\Models\Zones;
use Carbon\Carbon;
use Flugg\Responder\Transformers\Transformer;

class ZonesTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Zones $zones)
    {




        return [
            'id' => $zones->id,
            'name_ar' => $zones->AddresAr,
            'name_en' => $zones->AddresEn,
            'delivery' => $this->getDelivery($zones),

        ];
    }
    public static function getDelivery(Zones $zones)
    {
        // dd($zones);
        $start_time = Carbon::now()->toDateString();
        $end_time = Carbon::now()->addDay()->toDateString();
        $zonesOptions = ZoneOption::where('zone_id', $zones->id)->whereRaw("start_time >=  '$start_time'")->whereRaw("end_time <=  '$end_time'")->orderBy('id', 'desc')->first();
        
        if ($zonesOptions) {
            return $zonesOptions->delivery;
        }

        return json_decode($zones->delivery)[self::getNDay()] ?? $zones->delivery;
    }
    public static function getNDay()
    {
        $DayOfWeekNumber = date("w") + 1;
        if ($DayOfWeekNumber > 6) {
            $DayOfWeekNumber = 6;
        }
        return $DayOfWeekNumber;
    }
}
