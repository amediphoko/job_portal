<?php

namespace App\Http\Controllers\Auth;

use App\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class EmployerRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/employer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:employer');
    }

    public function showRegistrationForm()
    {
        return view('auth.employer-register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:employers',
            'location' => 'required|string|max:191',
            'industry' => 'required|string|max:191',
            'contacts' => 'required|integer',
            'logo' => 'image|nullable|max:1999',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new employer instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Employer
     */
    protected function create(array $data)
    {
        $request = app('request');
        if ($request->hasfile('logo')) {
            //Get filename with the extension
            $filenamewithExt = $request->file('logo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            //Get just the ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            //Filename to upload
            $fileNameToUpload = $filename.'_'.time().'.'.$extension;
            ///Upload Image
            $path = $request->file('logo')->storeAs('public/company_logos', $fileNameToUpload);
        } else {
            $fileNameToUpload = 'default.jpg';
        }
        
        return Employer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'location' => $data['location'],
            'industry' => $data['industry'],
            'contacts' => $data['contacts'],
            'logo' => $fileNameToUpload,
            'password' => bcrypt($data['password']),
        ]);
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($employer = $this->create($request->all())));

        Auth::guard('employer')->login($employer);

        return $this->registered($request, $employer)
                        ?: redirect(route('employer'));
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $employer)
    {
        //
    }


}
