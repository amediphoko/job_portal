<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Job;
use App\Application;

class ApplicationsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|unique:applications',
            'user_id' => 'required|integer',
            'employer_id' => 'required|integer',
            'job_id' => 'required|integer',
            'documents' => 'nullable',
            'documents.*' => 'mimes:pdf'
        ]);

        $documents = json_decode(auth()->user()->documents);

        foreach ($documents as $document) {
           // $path = $document->storeAs('public/applications/user'.auth()->user()->id, $document);
            $files[] = $document;
        }

        $application = new Application;
        $application->id = $request->input('id');
        $application->user_id = $request->input('user_id');
        $application->employer_id = $request->input('employer_id');
        $application->job_id = $request->input('job_id');
        $application->documents = json_encode ($files);
        $application->save();

        return redirect('/dashboard')->with('success', 'Application Submitted.');

    }

    /**
     * Update the specified resource column to "reviewed" in storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setReview($id)
    {
        $application = Application::find($id);
        $application->status = 'reviewed';
        $application->save();
        return redirect('/employer')->with('sucess', 'Review Done.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::find($id);
        if(auth()->user()->id !== $application->user_id) {
            return redirect('/dashboard')->with('error', 'UnAuthorized access.');
        }
        $application->delete();
        return redirect('/dashboard')->with('success', 'Application Deleted.');
    }
}
