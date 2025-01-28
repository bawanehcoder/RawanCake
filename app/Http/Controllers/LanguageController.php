<?php

namespace App\Http\Controllers;


use App\Events\AppLanguageChangedEvent;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeAppLanguageRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    public function changeLanguage(ChangeAppLanguageRequest $request){
        //save new language to session and user preference (db)

        $request->session()->put('app_language', strtolower($request->lang));
        App::setLocale(strtolower($request->lang));

        if(isLogged()){
           // getLogged()->setPreferenceByName('user.notification_language', $request->lang);
            event(new AppLanguageChangedEvent(getLogged()));
        }
        return redirect()->back()->with('message', __('language changed successfully'));
    }
}
