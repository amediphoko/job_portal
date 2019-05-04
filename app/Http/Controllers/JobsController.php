<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Job;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer', ['except' => ['index', 'show', 'catFilter', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //query results for all job entries
        $jobs_all = Job::all()->where('closing_date', '>=', Carbon::now());
        //filters job entries and return query
        $jobs = Job::filter($request)->orderBy('created_at', 'DESC')->paginate(5);
        //query results for unique job category entries
        $categories = Job::select('category')->distinct()->pluck('category');
        //query results for unique job type entries
        $types = Job::select('type')->distinct()->pluck('type');

        /**search query entry */
        $title = $request->title;
        $location = $request->location;

        return view('jobs.index')->with([   'jobs' => $jobs,
                                            'categories' => $categories,
                                            'jobs_all' => $jobs_all,
                                            'types' => $types,
                                            'title' => $title,
                                            'location' => $location]);

    }

    public function search(Request $request) {
        //query results for all job entries
        $jobs_all = Job::all()->where('closing_date', '>=', Carbon::now());
        //query results for unique job category entries
        $categories = Job::select('category')->distinct()->pluck('category');
        //query results for unique job type entries
        $types = Job::select('type')->distinct()->pluck('type');

        /**search function */
        $title = $request->title;
        $location = $request->location;


        //query jobs resource for search results
        if ($title != null and $location != null) {
            $data = Job::where('title', 'like', '%' . $title . '%')
                            ->orWhere('location', 'like', '%' . $location . '%')->paginate(5);
        } elseif ($title == null and $location != null) {
            $data = Job::where('location', 'like' , '%' . $location . '%')->paginate(5);
        } elseif ($title != null and $location == null) {
            $data = Job::where('title', 'like' , '%' . $title . '%')->paginate(5);
        }else{
            $data = null;
        }
        
        return view('jobs.index')->with(['jobs' => $data,
                                        'categories' => $categories,
                                        'jobs_all' => $jobs_all,
                                        'types' => $types,
                                        'title' => $title,
                                        'location' => $location]);
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
        if(auth()->user()){
            $applied = auth()->user()->applications()->where('job_id', $job->id)->get();
            return view('jobs.show')->with(['job'=> $job, 'applied'=> $applied]);
        }else{
            return view('jobs.show')->with('job', $job);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        //check for correct user
        if(auth()->user()->id !== $job->employer_id) {
            return redirect('/jobs')->with('error', 'UnAuthorised Page.');
        }
        return view('jobs.edit')->with('job', $job); 
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
        $job = Job::find($id);
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

        return redirect('/jobs')->with('success', 'Job Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        //check for correct user
        if(auth()->user()->id !== $job->employer_id) {
            return redirect('/jobs')->with('error', 'UnAuthorised Page.');
        }
        
        if (count($job->applications) > 0) {
            foreach ($job->applications as $application) {
                if ($application->status == 'pending') {
                    return redirect('/jobs')->with('error', 'Job Applications are still Pending.');
                    break;
                } else {
                    $application->delete();
                }
            }
            $job->delete();
            return redirect('/jobs')->with('success', 'Job Deleted');
        } else {
            $job->delete();
            return redirect('/jobs')->with('success', 'Job Deleted');
        }
    }
}
