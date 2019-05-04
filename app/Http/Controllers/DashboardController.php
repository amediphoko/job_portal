<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Inbox;
use App\Job;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'getDownload']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $categories = Job::select('category')->distinct()->pluck('category');
        $inboxes = Inbox::where('user_id', '=', $user_id)->filter($request)->orderBy('created_at', 'DESC')->paginate(4);
        return view('dashboard')->with(['applications' => $user->applications, 'inboxes' => $inboxes, 'categories' => $categories]);
    }

    public function getDownload($document)
    {
        $file = public_path()."\\storage\\documents\\".$document;

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, $document, $headers);
    }

    public function applications($id)
    {
        $user = User::find($id);
        
        return view('seeker.applications')->with('applications', $user->applications);
    }

    public function messages(Request $request, $id)
    {
        $inboxes = Inbox::where('user_id', '=', $id)->filter($request)->orderBy('created_at', 'DESC')->paginate(4);
        
        return view('seeker.messages')->with('inboxes', $inboxes);
    }

    public function profile()
    {   
        return view('seeker.profile');
    }

    public function coverInfo($id)
    {   
        return view('seeker.cv_cover');
    }

    public function showInbox($id)
    {
        $inbox = Inbox::find($id);
        $inbox->status = 'read';
        $inbox->save();
        
        return view('seeker.inbox')->with('inbox', $inbox);
    }

    public function searchInbox(Request $request) {
        $searchterm = $request->searchterm;


        //query inbox resource for search results
        if ($searchterm != null) {
            $inboxes = Inbox::where('subject', 'like', '%' . $searchterm . '%')->paginate(4);
        }else{
            $inboxes = null;
        }

        $applications = auth()->user()->applications;
        
        return view('seeker.messages')->with(['inboxes' => $inboxes, 'searchterm' => $searchterm, 'applications' => $applications]);
    }

    public function update(Request $request, $id) {
        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:191',
            'dob' => 'required|date',
            'gender' => 'required|string|max:6',
            'contacts' => 'required|integer',
            'residence' => 'required|string|max:191',
            'qualification' => 'required|string|max:191',
        ]);

        $user = User::find($id);
        if ($user->email != $request->input('email'))
        {
            $this->validate($request, [
                'email' => 'required|string|email|max:191|unique:users',
            ]);

            $user->email = $request->input('email');
        }

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->contacts = $request->input('contacts');
        $user->residence = $request->input('residence');
        $user->qualification = $request->input('qualification');
        $user->save();

        return back()->with('success', 'User details updated.');
    }

    public function img_update(Request $request, $id)
    {
        $this->validate($request, [
            'pro_pic' => 'image|nullable|max:1999',
        ]);

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
        }

        $user = User::find($id);

        if ($user->pro_pic != 'default.jpg') {
            Storage::delete('public/profile_pictures/'.$user->pro_pic);
        }

        $user->pro_pic = $fileNameToUpload;
        $user->save();

        return back()->with('success', 'Image successfully uploaded.');
    }

    public function update_documents(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'string|max:500',
        ]);

        $updated = false;
        $user = User::find($id);

        if($request->hasfile('documents')) {
            $this->validate($request, [
                'documents.*' => 'mimes:pdf',
            ]);

            foreach($request->file('documents') as $file){
                $name = $file->getClientOriginalName();
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileToUpload = $filename.'_'.time().'.'.$extension;
                $path = $file->storeAs('public/documents', $fileToUpload);
                $files[] = $fileToUpload;
            }

            $user->documents = json_encode($files);
            $updated = true;
        }
        if ($user->description != $request->input('description')) {

            $user->cover_letter = $request->input('description');
            $updated = true;
        }
        if ($updated) {
            $user->save();

            return back()->with('success', 'Documents updated.');
        }

        return back()->with('error', 'Provide valid information to update documents');
            
    }

    public function delete_msg(Request $request)
    {
        $checked_id = $request->input('inbox');
        Inbox::whereIn('id', $checked_id)->delete();

        return back()->with('success', 'Messages deleted successfully.');
    }
}
