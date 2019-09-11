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
////Admin area//////////
Route::get('admin/login','Admin\AuthController@getLogin');
Route::post('admin/login','Admin\AuthController@postLogin')->name('admin.login');
Route::get('admin/register','Admin\AuthController@getRegister');
Route::post('admin/register','Admin\AuthController@postRegister')->name('admin.register');
Route::get('admin/dashboard','AdminController@getIndex')->name('admin.dashboard');
Route::get('admin/logout','AdminController@getLogout');
////end of admin area/////
Route::get('/send','ChatController@send_public');//test
//
Route::get('/', 'PagesController@index');
///messenger
Route::get('/messenger', function () {
    return view('messenger');
})->middleware('auth')->name('messenger');
/////socket chat
Route::get('/socketchat', 'SocketController@index')->middleware('auth')->name('socketchat.index');
Route::get('/socketchat/{id}', 'SocketController@show')->middleware('auth')->name('socketchat.show');
Route::post('/socketchat/send','SocketController@store')->middleware('auth')->name('socketchat.store');

///public chat
Route::get('/getAllUser','ChatController@getAllUser');
Route::get('/messages','ChatController@getMessages');
Route::post('/sendMessage','ChatController@sendMessage');
Route::get('/public_chat', 'ChatController@public_chat')->name('chat.public_chat');
///////private chat
Route::get('/contacts', 'ChatController@get');
Route::get('/conversation/{id}', 'ChatController@getMessagesFor');
Route::post('/conversation/send', 'ChatController@send');
Route::get('/chat', 'ChatController@index')->name('chat.index');
/////Route Group user profile avatar
Route::group(['prefix'=>'/profile'],function(){
	Route::get('/',[
		'as'=>'profile',
		'uses'=>'UserController@profile'
	]);
	Route::post('/', 'UserController@update_avatar');
});
/*Route::group(['prefix'=>'/user'],function(){
    Route::get('{id}/following',[
	// 'middleware'=>'auth',
	'uses'=>'UserController@following'
]);  
});*/

/*Route::get('wall/{profileId}','ProfileController@wall');
Route::post('wall/{profileId}/follow', 'ProfileController@followUser')->name('user.follow');
Route::post('wall/{profileId}/unfollow', 'ProfileController@unFollowUser')->name('user.unfollow');
Route::get('show/{profileId}','ProfileController@show');*/

///list user, new_feed, wall view, follow...
Route::get('users', 'HomeController@users')->name('users');
Route::get('search_user','HomeController@search')->name('user.search');
Route::get('user/{id}', 'HomeController@user')->name('user.view');
Route::post('ajaxRequest', 'HomeController@ajaxRequest')->name('ajaxRequest');
Route::get('/news_feed', 'HomeController@index')->name('news_feed'); 

/////Route Group articles//////
Route::group(['prefix'=>'/articles'],function(){
	Route::get('',[
		'as'=>'article.index',
		'uses'=>'ArticlesController@index'
	]);
	Route::get('/create',[
		// 'middleware'=>'auth',
		'as'=>'article.create',
		'uses'=>'ArticlesController@create'
	]);
	Route::post('',[
		//'middleware'=>'auth',
		'as'=>'article.store',
		'uses'=>'ArticlesController@store'
	]);
	Route::get('/{id}/edit',[
		//'middleware'=>'auth',
		//'middleware'=>'checkforowner',
		'as'=>'article.edit',
		'uses'=>'ArticlesController@edit'
	]);
	Route::put('/{id}',[
		//'middleware'=>'auth',
		//'middleware'=>'checkforowner',
		'as'=>'article.update',
		'uses'=>'ArticlesController@update'
	]);

	Route::delete('/{id}',[
		//'middleware'=>'auth',
		//'middleware'=>'checkforowner',
		'as'=>'article.destroy',
		'uses'=>'ArticlesController@destroy'
	]);

	Route::get('/{id}',[
		'as'=>'article.show',
		'uses'=>'ArticlesController@show'
	]);
});
Route::get('/notowner',function(){
	echo "<center>Bạn không có quyền sửa/xóa nội dung của user khác!!!</center>";
})->name('notowner');
/*Route::get('/articles',[
	'as'=>'article.index',
	'uses'=>'ArticlesController@index'
]);
Route::get('/articles/create',[
	'middleware'=>'auth',
	'as'=>'article.create',
	'uses'=>'ArticlesController@create'
]);
Route::post('/articles',[
	'middleware'=>'auth',
	'as'=>'article.store',
	'uses'=>'ArticlesController@store'
]);
Route::get('/articles/{id}/edit',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'article.edit',
	'uses'=>'ArticlesController@edit'
]);
Route::put('/articles/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'article.update',
	'uses'=>'ArticlesController@update'
]);
Route::delete('articles/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'article.destroy',
	'uses'=>'ArticlesController@destroy'
]);
Route::get('/articles/{id}',[
	'as'=>'article.show',
	'uses'=>'ArticlesController@show'
]);*/

/*// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');*/

// Authentication Routes new 5.8...
Auth::routes();
/*Route::get('logout', 'Auth\LoginController@logout');*/
///comment
Route::group(['prefix'=>'/comment'],function(){
	Route::post('/{article_id}',[	
		//'middleware'=>'auth',
		'uses'=>'CommentController@store',
		'as'=>'comment.store'
	]);
	Route::get('/{id}/edit',[
		//'middleware'=>'auth',
		//'middleware'=>'checkforcomment',
		'as'=>'comment.edit',
		'uses'=>'CommentController@edit'
	]);
	Route::put('/{id}',[
		//'middleware'=>'auth',
		//'middleware'=>'checkforcomment',
		'as'=>'comment.update',
		'uses'=>'CommentController@update'
	]);
	Route::delete('/{id}',[
		//'middleware'=>'auth',
		//'middleware'=>'checkforcomment',
		'as'=>'comment.destroy',
		'uses'=>'CommentController@destroy'
	]);
});
/*Route::post('comment/{article_id}',[	
	'middleware'=>'auth',
	'uses'=>'CommentController@store',
	'as'=>'comment.store'
]);
Route::get('comment/{id}/edit',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'comment.edit',
	'uses'=>'CommentController@edit'
]);
    Route::put('comment/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'comment.update',
	'uses'=>'CommentController@update'
]);
Route::delete('comment/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'comment.destroy',
	'uses'=>'CommentController@destroy'
]);*/