<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employer;

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
    public function index()
    {
        $employer_id = auth('employer')->user()->id;
        $employer = Employer::find($employer_id);
        return view('employer')->with('jobs', $employer->jobs);
    }
}
