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
            'documents' => 'required',
            'documents.*' => 'mimes:pdf',
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
        if ($request->hasfile('pro_pic')) {
            //Get filename with the extension
            $filenamewithExt = $request->file('pro_pic')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            //Get just the ext
            $extension = $request->file('pro_pic')->getClientOriginalExtension();
            //Filename to upload
            $fileNameToUpload = $filename.'_'.time().'.'.$extension;
            ///Upload Image
            $path = $request->file('pro_pic')->storeAs('public/profile_pictures', $fileNameToUpload);
        }if ($request->hasfile('documents')) {
            foreach($request->file('documents') as $file){
                $name = $file->getClientOriginalName();
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileToUpload = $filename.'_'.time().'.'.$extension;
                $file->storeAs('public/documents', $fileToUpload);
                $files[] = $fileToUpload;
            }
        } else {
            $fileNameToUpload = 'default.jpg';
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
            'documents' => json_encode($files),
            'password' => bcrypt($data['password']),
        ]);
    }
}
