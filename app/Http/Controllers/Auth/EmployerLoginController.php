<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EmployerLoginController extends Controller
{

    public function __construct() 
    {
        $this->middleware('guest:employer', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.employer-login');
    }

    public function login(Request $request)
    {
        //Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //Attempt to log the user in to the system
        if (Auth::guard('employer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if successful, redirect user to their intended route
            return redirect()->intended(route('employer.dashboard'));
        }

        //if unsuccessful, then redirect user back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('employer')->logout();
        return redirect('/');
    }
}
