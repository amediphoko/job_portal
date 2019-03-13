<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class PagesController extends Controller
{
    public function index() {
        $jobs = Job::orderBy('created_at','desc')->take(4)->get();
        return view('pages.index')->with('jobs', $jobs);
    }

    public function aboutus() {
        return view('pages.aboutus');
    }

    public function search() {
        return view('pages.search');
    }

}
