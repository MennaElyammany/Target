<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;

class RequestController extends Controller
{
    function show(){
        $requests=Auth::user()->requests;
      
        return view('requests.show',['requests'=>$requests]);
    }
    function accept($id){
       
        $request= Request::findOrFail($id);
        $request->status='accepted';
        $request->save();

        return back();


    }
    function decline($id){
       
        $request= Request::findOrFail($id);
        $request->status='declined';
        $request->save();

        return back();


    }
    
}
