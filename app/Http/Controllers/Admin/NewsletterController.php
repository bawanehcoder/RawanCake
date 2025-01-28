<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportNewsletter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateNewsletterRequest;
use App\Models\Newsletter;
use App\Services\NewsletterService;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\Response;

use Maatwebsite\Excel\Facades\Excel;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Admin()->can('newsletter view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Newsletter::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.newsletters.index');
    }

    public function exportNewsletters()
    {
        return Excel::download(new ExportNewsletter(), now() . '-newsletter.xlsx');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateNewsletterRequest $request)
    {
        if (!Admin()->can('newsletter delete')) {
            abort(401);
        }
        return NewsletterService::deleteFromRequest($request);

    }
}
