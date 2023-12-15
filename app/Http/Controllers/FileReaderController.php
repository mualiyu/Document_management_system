<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Sharing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pdf()
    {
        return view('reader.pdf');
    }

    /**
     * Display a listing of the resource.
     */
    public function word($uuid)
    {
        $doc = Document::where('uuid', '=', $uuid)->get();

        if (count($doc)) {
            $doc = $doc[0];
            $file = explode('/', $doc->url);
            $file = end($file);

            $ext = explode('.', $file);
            $ext = end($ext);

            if ($ext == "docx" || $ext == "doc") {
                return view('reader.word', ['doc'=>$doc]);
            }else{
                return "Failed to load this document";
            }
        }else{
            return "Failed to load, This document is not Found!";
        }
    }


    public function shared($uuid, Request $request)
    {
        $sharing = Sharing::where(['uuid'=> $uuid, 'status'=>"1"])->get();
        if (Auth::check()) {
            $sharing = Sharing::where(['uuid'=> $uuid])->get();
            if (count($sharing)>0) {
                $sharing = $sharing[0];

                if ($sharing->type == 1) {
                    $type = "One Time";
                    return view('shared.share', ['sharing'=>$sharing, "type"=>$type, "request"=>$request]);
                }else{
                    $type = "Expiring on $sharing->stop_time";

                    $st = $sharing->stop_time.":00";
                    $st = explode('T', $st);
                    $st = $st[0]." ".$st[1];

                    if ((now() > $st) || $sharing->status == "0") {
                        $type = "Expired Already";
                    }

                    return view('shared.share', ['sharing'=>$sharing, "type"=>$type, "request"=>$request]);
                    }
            }else{
                abort("404");
            }
        }else{
            if (count($sharing)>0) {
                $sharing = $sharing[0];

                if ($sharing->type == 1) {
                    $type = "One Time";
                    Sharing::where(['uuid'=> $uuid, 'status'=>"1"])->update([
                        "status"=>"0",
                    ]);
                    return view('shared.share', ['sharing'=>$sharing, "type"=>$type, "request"=>$request]);
                }else{
                    $st = $sharing->stop_time.":00";
                    $st = explode('T', $st);
                    $st = $st[0]." ".$st[1];

                    // return (now() > $st) ? "yes":"no";   //testing logic
                    if (now() > $st) {
                        Sharing::where(['uuid'=> $uuid, 'status'=>"1"])->update([
                            "status"=>"0",
                        ]);
                        abort("404");
                    }else{
                        $type = "These files will expire on $sharing->stop_time";
                        return view('shared.share', ['sharing'=>$sharing, "type"=>$type, "request"=>$request]);
                    }
                    }
            }
            else{
                abort("404");
            }
        }


    }
}
