<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:191',
            'dob' => 'required|date',
            'gender' => 'required|string|max:6',
            'email' => 'required|string|email|max:255|unique:users',
            'pro_pic' => 'image|nullable|max:1999',
            'contacts' => 'required|integer',
            'residence' => 'required|string|max:191',
            'qualification' => 'required|string|max:191',
            'documents' => 'file|nullable',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = app('request');
        if ($request->hasfile('pro_pic') && $request->hasfile('documents')) {
            //Get filename with the extension
            $filenamewithExt = $request->file('pro_pic')->getClientOriginalName();
            //Get document name with the extension
            $docnamewithExt = $request->file('documents')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            //Get just document name
            $docname = pathinfo($docnamewithExt, PATHINFO_FILENAME);
            //Get just the ext
            $extension = $request->file('pro_pic')->getClientOriginalExtension();
            //Get the document ext
            $docext = $request->file('documents')->getClientOriginalExtension();
            //Filename to upload
            $fileNameToUpload = $filename.'_'.time().'.'.$extension;

            $docNameToUpload = $docname.'_'.time().'.'.$docext;
            ///Upload Image
            $path = $request->file('pro_pic')->storeAs('public/profile_pictures', $fileNameToUpload);
            //Upload Document
            $path = $request->file('documents')->storeAs('public/documents', $docNameToUpload);
        } else {
            $fileNameToUpload = 'default.jpg';
            $docNameToUpload = null;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'last_name' => $data['last_name'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'pro_pic' => $fileNameToUpload,
            'contacts' => $data['contacts'],
            'residence' => $data['residence'],
            'qualification' => $data['qualification'],
            'documents' => $docNameToUpload,
            'password' => bcrypt($data['password']),
        ]);
    }
}
