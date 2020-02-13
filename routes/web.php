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
//admins Routes
Route::group(['middleware'=>['auth','role:Admin']], function(){
    Route::get('/users','AdminController@index')->name('users.index');
    Route::get('/users/{user}/ban','AdminController@ban');
});
//facebook and google login routes
Route::get('login/facebook', 'Auth\FacebookLoginController@redirectToProviderFacebook');
Route::get('login/facebook/callback', 'Auth\FacebookLoginController@handleProviderFacebookCallback');
Route::get('login/google', 'Auth\GoogleLoginController@redirectToProviderGoogle');
Route::get('login/google/callback', 'Auth\GoogleLoginController@handleProviderGoogleCallback');

Route::get('login/instagram','Auth\InstagramLoginController@redirectToInstagramProvider')->name('instagram.login');
Route::get('login/instagram/callback', 'Auth\InstagramLoginController@instagramProviderCallback')->name('instagram.login.callback');

//twitter routes
Route::get('login/twitter', 'Auth\SocialAuthTwitterController@redirect');
Route::get('login/twitter/callback', 'Auth\SocialAuthTwitterController@callback');
Route::get('/twitter/tweets', 'TwitterController@twitterUserTimeLine');
Route::post('tweet', ['as'=>'post.tweet','uses'=>'TwitterController@tweet']);


//Influencers Routes
 Route::group(['middleware'=>'auth'], function(){
 Route::get('/influencers', 'InfluencerController@index')->name('influencers.index');
 Route::get('/influencers/create', 'InfluencerController@create')->name('influencers.create');
 Route::post('/influencers', 'InfluencerController@store')->name('influencers.store');
 Route::post('/influencers/view', 'InfluencerController@showYoutubeModal')->name('influencers.showYoutubeModal');
 Route::post('/influencers/{influencer}','InfluencerController@show')->name('influencers.show');
 Route::get('/influencers/instagram/{influencer}', 'InfluencerController@showInstagram')->name('influencers.showInstagram');
 Route::get('/influencers/twitter/{influencer}','InfluencerController@showTwitter')->name('influencers.showTwitter');
 Route::get('/influencers/posttwitter', 'InfluencerController@postTwitterView');
 Route::post('/sendTweet','InfluencerController@sendTweet');
});

//Charts Routes
Route::get('/subscriberschart/{id}','ChartDataController@getSubscribers');
Route::get('/genderchart/{id}','ChartDataController@getAudienceGender');
Route::get('/locationchart/{id}','ChartDataController@getAudienceLocation');
Route::get('/agechart/{id}','ChartDataController@getAudienceAge');
Route::get('/influencers/charts/{id}','ChartDataController@chart')->name('influencers.chart');

//Requests Routes
Route::group(['middleware'=>'auth'], function(){
Route::get('/requests','RequestController@index')->name('requests.index');
Route::get('requests/create','RequestController@create')->name('requests.create');
Route::get('/requests/{request}','RequestController@show')->name('requests.show');
Route::get('/requests/accept/{request}','RequestController@accept');
Route::get('/requests/decline/{request}','RequestController@decline');
Route::get('/requests/completed/{request}','RequestController@completed');
Route::get('/message/read','RequestController@read')->name('messages.read');
Route::post('/requests', 'RequestController@store')->name('requests.store');
Route::patch('/requests/{requestt}', 'RequestController@requestModified');

});
//Messages Routes
Route::group(['middleware'=>'auth'], function(){
    Route::get('/messages/create/{influencer}','MessageController@create')->name('messages.create');
    Route::post('/messages','MessageController@store')->name('messages.store');
    Route::get('/messages/index/{influencer}','MessageController@index')->name('messages.index');
    Route::get('/messages/displayConversation/{client}','MessageController@displayConversation')->name('messages.displayConversation');
    Route::post('/messages/storeInfluencer/{id}/{auth}/{msg}','MessageController@storeInfluencer')->name('messages.storeInfluencer');
});


//User profile routes
Route::get('/users/{user}', 'UserController@show')->name('users.show') -> middleware('auth'); 
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit') -> middleware('auth'); 
Route::put('/users/{user}', 'UserController@update')->name('users.update') -> middleware('auth');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.update') -> middleware('auth');



//when we get the price
//Route::get('/requests/checkout/{price}','RequestController@checkout')->name('requests.checkout');
Route::get('/requests/checkout','RequestController@checkout')->name('requests.checkout');
//Route::post('/requests/charge','RequestController@checkout')->name('requests.checkout');
Route::post('/requests/charge','RequestController@charge');
// ->name('requests.charge');


//Email Routes
Route::get('/sendemail','SendEmailController@index');
Route::post('/sendemail/send','SendEmailController@send');

//Rating 
Route::post('/rating','RequestController@storeRating')->name('requests.rating');
Route::get('/test','InfluencerController@test')->name('test');
