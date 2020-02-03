<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(){
        $users=User::all();
        return view('Admins.index',['users'=>$users]);
    }
}
