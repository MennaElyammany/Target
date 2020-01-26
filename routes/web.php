    <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFacebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['middleware'=>'auth'], function(){
Route::get('/influencers', 'InfluencerController@index')->name('influencers.index');
// Route::get('/influencers/{influencer}', 'InfluencerController@show');
Route::get('/influencers/create', 'InfluencerController@create')->name('influencers.create');
Route::post('/influencers', 'InfluencerController@store')->name('influencers.store');

//  });



Route::get('/influencers/about',function(){
    return view('about');
});
Route::get('/influencers/contactUs',function(){
    return view('contactUs');
});
Route::get('/influencers/{influencer}', 'InfluencerController@show')->middleware('auth');
