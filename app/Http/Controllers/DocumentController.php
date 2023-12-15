<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DocumentController extends Controller
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
        $documents = Document::orderBy('created_at', 'desc')->get();

        return view('documents.index', ["documents"=>$documents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'required',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($request->hasFile("file")) {
            $fileNameWExt = $request->file("file")->getClientOriginalName();
            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
            $fileExt = $request->file("file")->getClientOriginalExtension();
            $fileNameToStore = $fileName."_".time().".".$fileExt;
            $request->file("file")->storeAs("public/Documents", $fileNameToStore);

            $url = url('storage/Documents/'.$fileNameToStore);
        }else {
            $url = "";
        }

        if ($url) {
            $request['uuid'] = Str::uuid();
            $request['url'] = $url;

            // return $request->all();

            $document = Document::create($request->all());

            if ($document) {
                return redirect()->route('documents')->with('status', 'Document is added 👍');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('documents');
    }
}
