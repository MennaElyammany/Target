<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {   $countries= listCountries();
        $categories= listCategories();
        $user = Auth::user();
        $resultCountry=getCountryName($user->country_id);
        $resultCategory=getCategoryName($user->category_id);
        $country_name=$resultCountry[0]->country_name;
        $category_name=$resultCategory[0]->category_name;
        return view('users.edit', ['countries' => $countries,'categories'=>$categories,'user'=>$user,'country_name'=>$country_name,'category_name'=>$category_name]);
    }

    public function update(User $user)
    { 
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
        $user->password = bcrypt(request('password'));

        $user->save();

dd('success');

}

}
