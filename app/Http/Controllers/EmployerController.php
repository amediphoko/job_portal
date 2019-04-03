<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
