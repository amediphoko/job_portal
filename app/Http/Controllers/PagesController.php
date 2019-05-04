<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function index() {
        $posts = Post::where('status', 'active')->orderBy('created_at','desc')->take(3)->get();
        return view('pages.index')->with('posts', $posts);
    }

}
