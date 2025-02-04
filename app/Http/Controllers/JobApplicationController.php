<?php


namespace App\Http\Controllers;

use App\Models\JobApplication;
use Exception;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function showForm()
{
    return view('jobapplicationform'); 
}


    public function store(Request $request)
    {

        // dd($request->all());
        $validated = $request->all();

    //    $resumePath = $request->file('resume')->store('resumes', 'public');

      try{
        JobApplication::create($validated);
      }catch(Exception $ex){
        dd($ex->getMessage());
      }

        return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح.');
    }
}
