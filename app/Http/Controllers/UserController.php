<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use willvincent\Rateable\Rateable;
use willvincent\Rateable\Rating;



class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function show(User $user){

        $user = Auth::user();
        // $rating = new Rating;
        // $rating->rating = 5;
        // $rating->user_id = $user->id;
        // $user->ratings()->save($rating);
        // dd($user->ratings);

        if(!empty($user->country_id)&&!empty($user->category_id))
        {
        $resultCountry=getCountryName($user->country_id)?:[];
        $resultCategory=getCategoryName($user->category_id)?:[];
        $country_name=$resultCountry[0]->country_name;
        $category_name=$resultCategory[0]->category_name;
    }
        else 
        {
            $country_name='';
            $category_name='';
        }

        return view('users.show', ['user'=>$user,'country_name'=>$country_name,'category_name'=>$category_name]);

        
    }

    public function edit(User $user)
    {   $countries= listCountries();
        $categories= listCategories();
        $user = Auth::user();
        if(!empty($user->country_id)&&!empty($user->category_id))
        {
        $resultCountry=getCountryName($user->country_id)?:[];
        $resultCategory=getCategoryName($user->category_id)?:[];
        $country_name=$resultCountry[0]->country_name;
        $category_name=$resultCategory[0]->category_name;
    }
        else 
        {
            $country_name='';
            $category_name='';
        }
        return view('users.edit', ['countries' => $countries,'categories'=>$categories,'user'=>$user,'country_name'=>$country_name,'category_name'=>$category_name]);
    }

    public function update(User $user, request $request)
    { 
        // dd(asset('storage/goal.png'));
        $this->validate(request(), [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],            
        // 'password' => 'required|min:6'
        ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->country_id=request('country_id');
        $user->category_id=request('category_id');

        if(request()->avatar){
            $path = $request->file('avatar')->storeAs(
                'public', $user->id.'.png'
            );    
            $user->update(['avatar'=>asset('storage/'.$user->id.'.png')]);
            }
        $user->save();
        return redirect()->route('users.show',['user' => Auth::user()->id ]);

}

}
