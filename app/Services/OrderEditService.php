<?php

namespace App\Services;

use App\Exceptions\DuplicateElementException;
use App\Exceptions\SomethingWentWrongException;
use App\Models\OptionDetil;
use App\Models\OrderDetail;
use App\Models\OrderEdit;
use App\Repositories\GenralSettingRepository;
use App\Transformers\ZonesTransformer;
use Illuminate\Support\Facades\DB;
class OrderEditService
{
    public static function deleteOrder($entity, $item)
    {
        try {
            DB::beginTransaction();
            DraftService::saveDraft($entity, 'update');
            DraftService::saveDraft($item, 'delete');
            $price = $item->Quantity * $item->Price;
            $entity->AddValue = $entity->AddValue - $price;
            $entity->save();
            $item->delete();
            $editor = new OrderEdit([
                'OrderID' => $entity->id,
                'admin_id' => Admin()->id,
            ]);
            $editor->save();
            DB::commit();
            return 'successfully';
        } catch (\Exception $ex) {
            DB::rollback();
            return 'error';
        }
    }
    public static function updateOrder($request, $entity, $item)
    {
        try {
            DB::beginTransaction();
            DraftService::saveDraft($entity, 'update');
            DraftService::saveDraft($item, 'update');
            $editor = new OrderEdit([
                'OrderID' => $entity->id,
                'admin_id' => Admin()->id,
            ]);
            $editor->save();
            if ($request->quantity < $item->Quantity) {
                $differenceQ=$item->Quantity-$request->quantity;
                $price = $differenceQ * $item->Price;
                $entity->AddValue = $entity->AddValue - $price;
                $entity->save();
            } else if ($request->quantity > $item->Quantity) {
                $differenceQ=$request->quantity-$item->Quantity;
                $price = $differenceQ * $item->Price;
                $entity->AddValue = $entity->AddValue + $price;
                $entity->save();
            }
            $item->Quantity=$request->quantity;
            $item->save();
            DB::commit();
            return 'successfully';
        } catch (\Exception $ex) {
            DB::rollback();
            return 'error';
        }
    }
    public static function checkIsItem($optionDetil,$entity,$item){
        return OrderDetail::where('OrderID',$entity->id)->where('ItemID',$item->id)->where('OptID',$optionDetil)->exists();

    }
    public static function addItemOrder($request,$entity,$item){
        try {
            if(self::checkIsItem($request->data,$entity,$item)){
                return 'exists';
            }
            DB::beginTransaction();
            DraftService::saveDraft($entity, 'update');
            DraftService::saveDraft($item, 'add');
            $editor = new OrderEdit([
                'OrderID' => $entity->id,
                'admin_id' => Admin()->id,
            ]);
            $editor->save();
        $optionDetil= !empty($request->data)?OptionDetil::whereIn('id',json_decode($request->data)):null;


        $price = $item->price() + ($optionDetil ? $optionDetil->sum('AdditionalValue') : 0);

            OrderDetailsService::storeFromRequest([
            'OrderID' => $entity->id,
            'ItemID' => $item->id,
            'OptID' => $request->data,
            'Quantity' => 1,
            'Price' => $price,
            'Note' => '',
        ]);

            $entity->AddValue = $entity->AddValue + $price;
            $entity->save();
            DB::commit();
            return 'successfully';
        } catch (\Exception $ex) {
            DB::rollback();
            throw new SomethingWentWrongException();
        }
    }
    public static function changeDeliveryType($request,$entity){
        try {
            DB::beginTransaction();
            DraftService::saveDraft($entity, 'update');
            $entity->delivery_type=$request->type;
            if($request->type=='delivery_address'){
                $entity->AddValue = $entity->AddValue+$entity->ZonePrice;
            }else if($request->type=='personal_pickup'){
                $entity->AddValue = $entity->AddValue-$entity->ZonePrice;
            }
            $entity->save();
            DB::commit();
            return 'successfully';
        }catch (\Exception $ex){
            DB::rollback();
            return 'error';
        }
    }
    public static function changeZone($request,$entity){
             try {
                 if($entity->delivery_type=='delivery_address') {
                     DB::beginTransaction();
                     DraftService::saveDraft($entity, 'update');
                     $entity->ZoneID = $request->type;
                     $price_de = ZonesTransformer::getDelivery($entity->zone);

                     if ($entity->ZonePrice > $price_de) {
                         $entity->AddValue = $entity->AddValue - ($entity->ZonePrice - $price_de);
                     } else if ($entity->ZonePrice < $price_de) {
                         $entity->AddValue = $entity->AddValue + ($price_de - $entity->ZonePrice);
                     }


                     $entity->save();
                     DB::commit();
                     return 'successfully';
                 }
                 return 'delivery-type';
            }catch (\Exception $ex){
                DB::rollback();
                return 'error';
            }
        }
    public static function changeBranch($request,$entity){
             try {
                 if($entity->delivery_type=='personal_pickup') {
                     DB::beginTransaction();
                     DraftService::saveDraft($entity, 'update');
                     $entity->BranchID = $request->type;
                      $entity->save();
                     DB::commit();
                     return 'successfully';
                 }
                 return 'delivery-type';
            }catch (\Exception $ex){
                DB::rollback();
                return 'error';
            }
        }

}
