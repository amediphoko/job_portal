<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employer;
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
        $errors = ['email' => trans('auth.failed')];
        $message = ['email' => 'This account is not yet active'];
        //Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        $status = Employer::select('status')->where('email', '=', $request->email)->pluck('status');
        
        if (count($status) > 0) {
            if($status[0] == 'active') {
                //Attempt to log the user in to the system
                if (Auth::guard('employer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    //if successful, redirect user to their intended route
                    return redirect()->intended(route('employer.dashboard'));
                }

                //if unsuccessful, then redirect user back to the login with the form data
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors($errors);
            }
            
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors($message);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors($errors);
    }

    public function logout()
    {
        Auth::guard('employer')->logout();
        return redirect('/');
    }
}
