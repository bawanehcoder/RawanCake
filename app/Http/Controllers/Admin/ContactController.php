<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use App\Services\StringHelpers;
use Illuminate\Http\Request;
use DataTables;
class ContactController extends Controller
{
    public function index(Request $request)
    {
        if(!Admin()->can('contact view')){
            abort(401);
        }
        if ($request->ajax()) {
            $data = Contact::select('*')->orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('IsReplayed', function ($row) {
                   return __($row->IsReplayed);
                })
                ->addColumn('IsReaded', function ($row) {
                    return __($row->IsReaded);
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => true,
                        'showEditButton' => false,
                        'showDeleteButton' => true,
                    ])->render();
                })
                ->setRowClass(function ($row) {

                    return $row->IsReaded == 'readed' ? 'bg-success-subtle' : 'bg-warning-subtle';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.contact.index');
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $entity)
    {
        if(!Admin()->can('contact view')){
            abort(401);
        }
        $entity->readed();
        return view('admin.contact.edit', ['entity' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $entity)
    {
       // return view('admin.contact.edit', ['entity' => $entity]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $entity)
    {
        if(!Admin()->can('contact edit')){
            abort(401);
        }
        ContactService::updateFromRequest($entity,$request);
        return redirect()->back()->with('message', __('the message has been sent successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $entity)
    {
        if(!Admin()->can('contact delete')){
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
