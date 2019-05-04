<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewApplication;
use  App\Job;
use App\Application;
use App\Employer;
use App\User;
use App\Inbox;

class ApplicationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['setReview', 'shortlist']]);
    }

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
            Storage::copy('public/documents/'.$document, 'public/applications/user'.auth()->user()->id.'/'.$document);
            $files[] = $document;
        }

        $application = new Application;
        $application->id = $request->input('id');
        $application->user_id = $request->input('user_id');
        $application->employer_id = $request->input('employer_id');
        $application->job_id = $request->input('job_id');
        $application->documents = json_encode ($files);
        $application->save();

        $employer = Employer::findOrFail($request->input('employer_id'));
        $job = Job::findOrFail($request->input('job_id'));

        $employer->notify(new NewApplication(auth()->user(), $job));

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
        return redirect('employer.applications')->with('sucess', 'Review Done.');
    }

     /**
     * Update the specified resource column to "shortlist" in storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function shortlist($id)
    {
        $application = Application::find($id);
        $application->status = 'shortlisted';
        $application->save();
        
        $subject = 'Response on your '.$application->job->title.' job application';
        $message = ('<p>Hi,'
                    .'<br>We would like to inform you that you have been shortlisted for the '
                    .'<b>'.$application->job->title.'</b>'
                    .' vacancy posted on the '.$application->job->created_at->toDateString().',' 
                    .'further details on the process will follow shortly on your email:'
                    .'<a href="">'.$application->user->email.'</a><br><br>Thank You<br>'.$application->employer->name.'</p>');

        //Store a newly created inbox resource in storage.
        $inbox = new Inbox;
        $inbox->user_id = $application->user_id;
        $inbox->employer_id = $application->employer_id;
        $inbox->subject = $subject;
        $inbox->message = $message;
        $inbox->save();

        $user = User::findOrFail($application->user_id);

        $user->notify(new NewApplication(auth('employer')->user(), $application->job));

        return back()->with('sucess', 'User has been shortlisted.');
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

        if($application->documents != NULL) {
            foreach($application->documents as $document) {
                Storage::delete('public/applications/user/'.auth()->user()->id.'/'.$document);
            }
        }
        $application->delete();
        return redirect('/dashboard')->with('success', 'Application Deleted.');
    }
}
