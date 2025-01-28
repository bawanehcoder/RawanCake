<?php

namespace App\Models;

use App\Transformers\ContactTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model implements Transformable
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'Date',
        'Name',
        'EMail',
        'Phone',
        'Message',
        'Replay',
        'IsReaded',
        'IsReplayed',
        'blob',
    ];
    protected $dates = [
        'Date',
    ];

    public function transformer()
    {
        return ContactTransformer::class;
    }
    public function getIsReplayedAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'waiting';
            case 1:
                return 'completed';

        }
    }
    public function getIsReadedAttribute($value)
        {
            switch ($value) {
                case 0:
                    return 'not readed';
                case 1:
                    return 'readed';

            }
        }
    public function readed()
    {
        $this->IsReaded = 1;
        $this->save();
    }
}
