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
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $inboxes = Inbox::where('user_id', '=', $user_id)->paginate(5);
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
        return view('inbox')->with('inbox', $inbox);
    }
}
