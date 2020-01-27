<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    function show($id){
        $requests=Auth::user()->requests;
        return view('requests.show',['requests'=>$requests]);
    }
    
    
}
