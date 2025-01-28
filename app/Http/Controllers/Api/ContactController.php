<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DataTables;
class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::select('*');
        return responder()->success($query)->respond();
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
    public function store(ContactRequest $request)
    {
        return ContactService::storeFromRequest($request)? responder()->success([ __('the message has been sent successfully')])->respond(): responder()->error(500, __('something went wrong'))->respond();
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
    public function destroy(string $id)
    {
        //
    }
}
