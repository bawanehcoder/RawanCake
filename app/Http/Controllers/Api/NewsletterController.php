<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsletterRequest;
use App\Http\Requests\Admin\UpdateNewsletterRequest;
use App\Models\Newsletter;
use App\Services\NewsletterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateNewsletterRequest $request)
    {

        $newsletter = NewsletterService::deleteFromRequest($request);
        switch ($newsletter) {
            case Response::HTTP_OK:
                return responder()->success([__('deleted successfully')])->respond();
                break;
            case Response::HTTP_NOT_FOUND:
                return responder()->success([__('the email is not available')])->respond();
                break;
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
                break;
        }
    }
}
