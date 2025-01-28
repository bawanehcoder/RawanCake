<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Services\ContactService;


class ContactUsController extends Controller
{
    public function show(){return view('site.contact-us');}
    public function sendMessageToAdmin(ContactRequest $request){
        ContactService::storeFromRequest($request);
        return  redirect()->back()->with('message', __('the message has been sent successfully'));
    }

}
