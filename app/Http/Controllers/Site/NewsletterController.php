<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsletterRequest;
use App\Services\NewsletterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request)
    {

        $newsletter = NewsletterService::storeFromRequest($request);
        switch ($newsletter) {
            case Response::HTTP_OK:
                return responder()->success([__('the subscription to the mailing list was successful')])->respond();
                break;
            case Response::HTTP_CONFLICT:
                return responder()->success([__('already subscribed')])->respond();
                break;
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
                break;
        }
    }
}
