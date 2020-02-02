    <?php

//Main routes
Route::get('/', function () { return view('welcome');})->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/influencers/about',function(){return view('about');});
Route::get('/influencers/contactUs',function(){ return view('contactUs');});

//Registerantion and login routes instead of // Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Auth::routes();
//facebook and google login routes
Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFacebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
Route::get('login/google', 'Auth\LoginController@redirectToProviderGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');



//Influencers Routes
    Route::group(['middleware'=>'auth'], function(){
    Route::get('/influencers', 'InfluencerController@index')->name('influencers.index');
    Route::get('/influencers/create', 'InfluencerController@create')->name('influencers.create');
    Route::post('/influencers', 'InfluencerController@store')->name('influencers.store');
    Route::get('/influencers/{influencer}', 'InfluencerController@show')->name('influencers.show') ;
});

Route::get('/charts/{id}','ChartDataController@getSubscribers');
Route::get('/influencers/charts/{id}','ChartDataController@chart')->name('influencers.chart');

//Requests Routes
Route::group(['middleware'=>'auth'], function(){
Route::get('/requests','RequestController@index')->name('requests.index');
Route::get('requests/create','RequestController@create')->name('requests.create');
Route::get('/message/read','RequestController@read')->name('messages.read');
Route::get('/requests/{request}','RequestController@show')->name('requests.show');
Route::get('/requests/accept/{request}','RequestController@accept');
Route::get('/requests/decline/{request}','RequestController@decline');
Route::get('/requests/completed/{request}','RequestController@completed');
Route::post('/requests', 'RequestController@store')->name('requests.store');
Route::patch('/requests/{requestt}', 'RequestController@requestModified');

});

//User profile routes
Route::get('/users/{user}', 'UserController@show')->name('users.show') -> middleware('auth'); 
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit') -> middleware('auth'); 
Route::put('/users/{user}', 'UserController@update')->name('users.update') -> middleware('auth');


//when we get the price
//Route::get('/requests/checkout/{price}','RequestController@checkout')->name('requests.checkout');
Route::get('/requests/checkout','RequestController@checkout')->name('requests.checkout');
//Route::post('/requests/charge','RequestController@checkout')->name('requests.checkout');
Route::post('/requests/charge','RequestController@charge');
// ->name('requests.charge');
