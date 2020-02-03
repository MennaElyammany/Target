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

    function show($id){
        if( Auth::user()->id==$id)
        $user = Auth::user();
        else
        $user=User::findOrFail($id);
        // $rating = new Rating;
        // $rating->rating = 3;
        // $rating->user_id = $user->id;
        // $user->ratings()->save($rating);
        // dd($user->averageRating);

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

    public function edit($id)
    {   $countries= listCountries();
        $categories= listCategories();
        if( Auth::user()->id==$id)
        $user = Auth::user();
        else
        $user=User::findOrFail($id);
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
        
        $this->validate(request(), [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],            
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
function destroy($id){
    $user = User::findOrFail($id);
        if($user['avatar']&&$user['role']=='Client')
        {
         
        unlink(asset($user['avatar'])); //delete image from storage
      
        }
        $user->delete();
        return redirect()->view('Admins.index');
}
public function review(User $user)
{


}
}
