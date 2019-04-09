<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Inbox;

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
        $inboxes = Inbox::where('user_id', '=', $user_id)->filter($request)->orderBy('created_at', 'DESC')->paginate(4);
        return view('dashboard')->with(['applications' => $user->applications, 'inboxes' => $inboxes]);
    }

    public function getDownload($document)
    {
        $file = public_path()."\\storage\\documents\\".$document;

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, $document, $headers);
    }

    public function showInbox($id)
    {
        $inbox = Inbox::find($id);
        $inbox->status = 'read';
        $inbox->save();
        
        return view('inbox')->with('inbox', $inbox);
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
        
        return view('/dashboard')->with(['inboxes' => $inboxes, 'searchterm' => $searchterm, 'applications' => $applications]);
    }
}
