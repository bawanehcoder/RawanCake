<?php

namespace App\Models;
use App\Models\Traits\SoftCascadeTrait;
use App\Services\NotificationsMappingLoader;
use App\Transformers\NotificationTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification;
class Notification extends DatabaseNotification implements Transformable
{
    use HasFactory;
    use SoftCascadeTrait;
    protected $softCascade = []; //array of relation names(only hasMany)
    protected $fillable = [
    ];

    public $formattedNotificationData;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function transformer()
    {
        return NotificationTransformer::class;
    }
    public function getFormattedNotificationData(){
        $formatterData = app()->make(NotificationsMappingLoader::class)->getFormatter($this->type);
        //get data the formatter class needed to format notification
        $neededDataByFormatter = $this->getNeededDataForFormatterClass($formatterData['params']);
        //pass needed params to formatter class and get formatted data
        $this->formattedNotificationData = app()->make($formatterData['formatterClass'],['entity'=> $neededDataByFormatter])->getFormattedData($this);
        return $this->formattedNotificationData;

    }
    public function getShortedFormattedContent(){
        $this->getFormattedNotificationData();
        return strip_tags($this->formattedNotificationData['content'], ['b']);
    }

    public function getNeededDataForFormatterClass(){
        return getEntity(
            $this->data['entity_type'],
            $this->data['entity_id'],
         );
    }
    public function getSenderName(){
        $this->getFormattedNotificationData();
        return $this->formattedNotificationData['sender_name'];
    }

    public function getSenderAvatar(){
        $this->getFormattedNotificationData();

        return $this->formattedNotificationData['sender_avatar'];
    }

    public function isFromAdmin(){
        $this->getFormattedNotificationData();
        return $this->formattedNotificationData['is_from_admin'];
    }

    public function getRedirectUrl(){
        $this->getFormattedNotificationData();
        return $this->formattedNotificationData['redirect_url'];
    }
    public function getFormattedContent(){
        $this->getFormattedNotificationData();

        return strip_tags($this->formattedNotificationData['content'], ['b']);
    }
}
