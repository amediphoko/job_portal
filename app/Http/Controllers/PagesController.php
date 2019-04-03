<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class PagesController extends Controller
{
    public function index() {
        $jobs = Job::orderBy('created_at','desc')->take(3)->get();
        return view('pages.index')->with('jobs', $jobs);
    }

    public function forum() {
        return view('pages.forum');
    }

    public function search(Request $request) {
        $title = $request->title;
        $location = $request->location;


        //query jobs resource for search results
        if ($title != null and $location != null) {
            $data = Job::where('title', 'like', '%' . $title . '%')
                            ->orWhere('location', 'like', '%' . $location . '%')->get();
        } elseif ($title == null and $location != null) {
            $data = Job::where('location', 'like' , '%' . $location . '%')->get();
        } elseif ($title != null and $location == null) {
            $data = Job::where('title', 'like' , '%' . $title . '%')->get();
        }else{
            $data = null;
        }
        
        return view('pages.search')->with(['data' => $data, 'title' => $title, 'location' => $location]);
    }

}
