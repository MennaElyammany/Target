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
    function ban($id){
        $user = User::findOrFail($id);
        if($user->isBanned())
        $user->unban();
        else
        $user->ban([
            'expired_at' => '+2 week',    //unban after week
        ]);

        return redirect()->route('users.index');


    }

}
