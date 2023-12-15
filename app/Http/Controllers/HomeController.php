<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Sharing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();

        $active_sharings = Sharing::where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $inactive_sharings = Sharing::where('status', '=', '0')->orderBy('created_at', 'desc')->get();


        return view('home', ["documents"=>$documents, "active_sharings"=>$active_sharings, "inactive_sharings"=>$inactive_sharings]);
    }
}
