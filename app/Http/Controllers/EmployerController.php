<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Employer;
use App\Job;
use App\Application;


class EmployerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employer_id = auth('employer')->user()->id;
        $employer = Employer::find($employer_id);
        //query results for unique job title entries
        $titles = Job::select('title')->where('employer_id', '=', $employer_id)->distinct()->pluck('title');
        //return ids on job entries filter by title
        $job_ids = Job::select('id')->filter($request)->where('employer_id', '=', $employer_id)->get();
        //query jobs
        $jobs = Job::whereIn('id', $job_ids)->get();
        //query applications
        $applications = Application::whereIn('job_id', $job_ids)->get();

        return view('employer')->with(['jobs'=> $jobs, 'applications'=> $applications, 'titles' => $titles]);
    }

    public function jobsPosted($id)
    {
        $jobs= Job::where('employer_id', '=', $id)->get();

        return view('employer.jobs_posted')->with('jobs', $jobs);
    }

    public function applications($status_id)
    {
        $employer_id = auth('employer')->user()->id;

        $job_ids = Job::select('id')->where('employer_id', '=', $employer_id)->get();

        $status = '';

        $jobs = [];

        if ($status_id == 1) {
            $status = 'pending';
            $applications = Application::whereIn('job_id', $job_ids)->where('status', '=', 'pending')->get();
        } elseif ($status_id == 2) {
            $status = 'reviewed';
            $applications = Application::whereIn('job_id', $job_ids)->where('status', '=', 'reviewed')->get();
        } elseif ($status_id == 3) {
            $status = 'shortlisted';
            $applications = Application::whereIn('job_id', $job_ids)->where('status', '=', 'shortlisted')->get();
        }

        if (count($applications) > 0) {
            foreach ($applications as $application) {
                $job_id[] = $application->job_id;
            }

            $jobs = Job::whereIn('id', $job_id)->distinct()->get();
        }

        return view('employer.applications')->with(['jobs'=> $jobs, 'applications'=> $applications, 'status' => $status]);
    }

    public function pending($job_id)
    {
        $status = 'pending';
        //query result for applications on a specific job
        $job_applications = Application::where('job_id', $job_id)
                                        ->where('status', '=', 'pending')->orderBy('created_at', 'DESC')->get();

        return view('employer.job_applications')->with(['job_applications' => $job_applications, 'status' => $status]);        
    }

    public function reviewed($job_id)
    {
        $status = 'reviewed';
        //query result for applications on a specific job
        $job_applications = Application::where('job_id', $job_id)
                                        ->where('status', '=', 'reviewed')->orderBy('created_at', 'DESC')->get();

        return view('employer.job_applications')->with(['job_applications' => $job_applications, 'status' => $status]);        
    }

    public function shortlisted($job_id)
    {
        $status = 'shortlisted';
        //query result for applications on a specific job
        $job_applications = Application::where('job_id', $job_id)
                                        ->where('status', '=', 'shortlisted')->orderBy('created_at', 'DESC')->get();
        
        foreach ($job_applications as $application) {
            $receipients[] = $application->user->email;
        }

        return view('employer.job_applications')->with(['job_applications'=> $job_applications,
                                                        'status' => $status,
                                                        'receipients' => $receipients]);        
    }

    public function profile()
    {
        return view('employer.profile');
    }

    public function sendmail(Request $request)
    {
        $this->validate($request, [
            'emails' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $emails = json_decode($request->input('emails'));
        $emp_email = auth('employer')->user()->email;
        $emp_name = auth('employer')->user()->name;

        $data = array(
            'message' => $request->input('message'),
            'sender' => auth('employer')->user()->name
        );
        
        Mail::send('employer.response', ['data' => $data], 
            function($message) use ($request, $emails, $emp_email, $emp_name) {
                $message->from($emp_email, $emp_name);
                $message->to($emails);
                $message->subject($request->input('subject'));
            }
        );
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'location' => 'required|string|max:191',
            'industry' => 'required|string|max:191',
            'contacts' => 'required|integer',
        ]);

        //$id = auth('employer')->user()->id;
        $employer = Employer::find($id);
        if ($employer->email != $request->input('email'))
        {
            $this->validate($request, [
                'email' => 'required|string|email|max:191|unique:employers',
            ]);

            $employer->email = $request->input('email');
        }

        $employer->name = $request->input('name');
        $employer->location = $request->input('location');
        $employer->industry = $request->input('industry');
        $employer->contacts = $request->input('contacts');
        $employer->save();

        return back()->with('success', 'Profile Updated');
    }

    public function logo_update(Request $request, $id)
    {
        $this->validate($request, [
            'logo' => 'image|nullable|max:1999',
        ]);

        if ($request->hasfile('logo')) {
            //Get filename with the extension
            $filenamewithExt = $request->file('logo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            //Get just the ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            //Filename to upload
            $fileNameToUpload = $filename.'_'.time().'.'.$extension;
            ///Upload Image
            $path = $request->file('logo')->storeAs('public/company_logos', $fileNameToUpload);
        }

        $employer = Employer::find($id);

        if ($employer->logo != 'img/default.jpg') {
            Storage::delete('public/company_logos/'.$employer->logo);
        }

        $employer->logo = $fileNameToUpload;
        $employer->save();

        return back()->with('success', 'Logo successfully uploaded.');
    }
}
