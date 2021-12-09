<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Slideshow extends Controller
{
    //
    public function index(){
        $folder=config("laraframer.folder");
        $files=Storage::disk("public")->allFiles($folder);
        $images=[];
        foreach($files as $file){
            $images[]=Storage::url($file);
        }
        return view('slideshow.index',[
            'images'    =>  $images,
        ]);

    }
}
