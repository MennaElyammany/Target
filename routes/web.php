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
Route::get('/influencers/about',function(){
    return view('about');
});
Route::get('/influencers/contactUs',function(){
    return view('contactUs');
});
Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFacebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
Route::get('login/google', 'Auth\LoginController@redirectToProviderGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');

// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/home', 'HomeController@index')->name('home');

 Route::group(['middleware'=>'auth'], function(){
 Route::get('/influencers', 'InfluencerController@index')->name('influencers.index');
 Route::get('/influencers/create', 'InfluencerController@create')->name('influencers.create');

 Route::get('/influencers/{influencer}', 'InfluencerController@show');

Route::get('/influencers', 'InfluencerController@index')->name('influencers.index');
});


Route::POST('influencers/create','InfluencerController@create')->name('influencers.create');

Route::get('/influencers/{influencer}', 'InfluencerController@show')->middleware('auth');

Route::post('/requests', 'RequestController@store')->name('requests.store');
Route::get('/requests','RequestController@show')->name('requests.show');
Route::get('/requests/accept/{request}','RequestController@accept');
Route::get('/requests/decline/{request}','RequestController@decline');
Route::get('/message/read','RequestController@read');
Route::get('requests/create','RequestController@create')->name('requests.create');