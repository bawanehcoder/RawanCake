<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Page;


class PageController extends Controller
{
    public function show($routeName)
    {
        $page = Page::where('route_name', $routeName)->firstOrFail();



        // $this->authorizeForUser(getLogged(), 'view', $page);
        return view('site.pages.show', [
            'page' => $page,
        ]);
    }
}
