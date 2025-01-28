<?php

namespace App\Transformers;


use App\Models\Contact;

use Flugg\Responder\Transformers\Transformer;

class ContactTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Contact $contact){





        return [




        ];
    }
}
