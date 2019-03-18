<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Job;
use App\Application;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id' => 'required|integer|unique:applications',
            'employer_id' => 'required|integer|unique:applications',
            'job_id' => 'required|integer|unique:applications',
            'documents' => 'required|nullable',
        ]);

        $application = new Application;
        $application->id = $request->input('id');
        $application->user_id = $request->input('user_id');
        $application->employer_id = $request->input('employer_id');
        $application->job_id = $request->input('job_id');
        $application->documents = $request->input('documents');
        $application->save();

        return redirect('/dashboard')->with('success', 'Application Submitted.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
