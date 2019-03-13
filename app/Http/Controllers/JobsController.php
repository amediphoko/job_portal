<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $jobs = Job::all();
        $jobs = Job::orderBy('created_at', 'desc')->paginate(7);
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
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
            'title' => 'required',
            'location' => 'required',
            'category' => 'required',
            'type' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'salary' => 'required',
            'closing_date' => 'required',
            'description' => 'required'
        ]);
        
        //Create New Job
        $job = new Job;
        $job->title = $request->input('title');
        $job->location = $request->input('location');
        $job->category = $request->input('category');
        $job->type = $request->input('type');
        $job->experience = $request->input('experience');
        $job->qualification = $request->input('qualification');
        $job->salary = $request->input('salary');
        $job->closing_date = $request->input('closing_date');
        $job->description = $request->input('description');
        $job->employer_id = auth('employer')->user()->id;
        $job->save();

        return redirect('/jobs')->with('success', 'Job Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
