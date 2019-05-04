<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Employer;
use App\Mail\EmployerRegister;
use App\Post;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active_employers = Employer::where('status', '=', 'active')->get();
        $requests = Employer::where('status', '=', 'inactive')->get();
        $employers = Employer::all();
        $posts = Post::where('status', 'inactive')->get();

        return view('admin.dashboard')->with(['active_employers' => $active_employers, 'requests' => $requests, 'employers' => $employers, 'posts' => $posts]);
    }

    public function accountRequests()
    {
        $employers = Employer::where('status', '=', 'inactive')->orderBy('created_at', 'DESC')->get();

        return view('admin.manage-employers')->with('employers', $employers);
    }

    public function postRequests()
    {
        $posts = Post::where('status', '=', 'inactive')->orderBy('created_at', 'DESC')->get();

        return view('admin.manage-posts')->with('posts', $posts);
    }

    public function acceptAccount($id)
    {
        $employer = Employer::find($id);
        $employer->status = 'active';
        $employer->save();

        /*send email*/
        $data = [
            'name' => $employer->name,
        ];

        Mail::to($employer->email)->send(new EmployerRegister($data));

        return redirect('/admin')->with('success', $employer->name.'\'s account request Accepted.');
    }

    public function acceptPost($id)
    {
        $post = Post::find($id);
        $post->status = 'active';
        $post->save();

        return redirect('/admin')->with('success', $post->title.' post has been approved.');
    }

    public function destroy($id)
    {
        $employer = Employer::find($id);
        $employer->delete();

        return redirect('/admin')->with('success', $employer->name.'\'s account request Declined.');
    }

    public function delete_post($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/admin')->with('success', $post->title.' post Declined.');
    }

    public function accountInfo()
    {
        $admin = auth('admin')->user();

        return view('admin.account-info')->with('admin', $admin);
    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'newpassword' => 'required|string|min:6',
            'confirmpassword' => 'required',
        ]);
        
        if (Hash::check($request->input('password'), $request->input('oldpassword'))) {
            if ($request->input('newpassword') == $request->input('confirmpassword')) {
                $admin = auth('admin')->user();
                $admin->password = bcrypt($request->input('newpassword'));
                $admin->save();

                return redirect('/admin')->with('success', 'Password Changed');
            } else {
                return back()->with('error', 'New Password does not match confirm');
            }
        } else {
            return back()->with('error', 'Current Password does not match password');
        }
    }
}