<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentSharing;
use App\Models\Sharing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SharingController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $active_sharings = Sharing::where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $inactive_sharings = Sharing::where('status', '=', '0')->orderBy('created_at', 'desc')->get();


        return view('shared.index', ["active_sharings"=>$active_sharings, "inactive_sharings"=>$inactive_sharings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return view('shared.create', ["documents"=>$documents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'terms' => 'required',
            'n_d_a' => 'required',
            'type' => 'required',
            'start_time' => 'nullable',
            'stop_time' => 'nullable',
            'documents' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with("val", $validator->errors());
        }

        if ($request->type == "2") {
            if ($request->stop_time == null) {
                return back()->with('status', "Make sure you select StopTime before proceding");
            }
        }
        if (isset($request->documents)) {
            # code...
            if (!count($request->documents)>0) {
                return back()->with('status', "Make sure to choose at least one document!");
            }
        }else{
            return back()->with('status', "Make sure to choose at least one document!");
        }

        return view('shared.review', ['data'=>$request->all()]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'terms' => 'required',
            'n_d_a' => 'required',
            'type' => 'required',
            'start_time' => 'nullable',
            'stop_time' => 'nullable',
            'documents' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with("val", $validator->errors());
        }

        if ($request->type == "2") {
            if ($request->stop_time == null) {
                return back()->with('status', "Make sure you select StopTime before proceding");
            }
        }
        if (isset($request->documents)) {
            # code...
            if (!count($request->documents)>0) {
                return back()->with('status', "Make sure to choose at least one document!");
            }
        }else{
            return back()->with('status', "Make sure to choose at least one document!");
        }

        $uuid = Str::uuid();

        $sharing = Sharing::create([
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'start_time' => $request->start_time,
            'stop_time' => $request->stop_time,
            'status' => "1",
            'uuid' => $uuid,
            'description' => $request->description,
            'terms' => $request->terms,
            'n_d_a' => $request->n_d_a,
        ]);

        if ($sharing) {
            foreach ($request->documents as $key => $d) {
                DocumentSharing::create([
                    'document_id'=>$d,
                    'sharing_id'=>$sharing->id
                ]);
            }
            return redirect()->route('sharings')->with('status', "You have succesfully shared documents");
        }else{
            return back()->with('status', "Failed! Try again.");
        }

    }



    /**
     * Display the specified resource.
     */
    public function show(Sharing $sharing)
    {
        return view('shared.info', ['sharing'=>$sharing]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sharing $sharing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sharing $sharing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sharing $sharing)
    {
        $sharing->delete();

        return redirect()->route('sharings');
    }
}
