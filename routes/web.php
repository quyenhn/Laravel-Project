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

/*Route::get('/', function () {
    // return view('welcome');
    return "Hello Quyen";
});*/

/////Route Group user profile///////
Route::group(['prefix'=>'/profile'],function(){
    Route::get('/',[
'middleware'=>'auth',
'uses'=>'UserController@profile'
]);
    Route::post('/', 'UserController@update_avatar');
});

/*Route::get('profile',[
'middleware'=>'auth',
'uses'=>'UserController@profile'
]);
Route::post('profile', 'UserController@update_avatar');*/

/////Route Group articles//////
Route::group(['prefix'=>'/articles'],function(){
    Route::get('',[
	'as'=>'article.index',
	'uses'=>'ArticlesController@index'
]);
    Route::get('/create',[
	'middleware'=>'auth',
	'as'=>'article.create',
	'uses'=>'ArticlesController@create'
]);
    Route::post('',[
	'middleware'=>'auth',
	'as'=>'article.store',
	'uses'=>'ArticlesController@store'
]);
    Route::get('/{id}/edit',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'article.edit',
	'uses'=>'ArticlesController@edit'
]);
    Route::put('/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'article.update',
	'uses'=>'ArticlesController@update'
]);

Route::delete('/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'article.destroy',
	'uses'=>'ArticlesController@destroy'
]);

Route::get('/{id}',[
	'as'=>'article.show',
	'uses'=>'ArticlesController@show'
]);
});
Route::get('/notowner',function(){
  echo "Bạn không có quyền sửa/xóa nội dung của user khác!!!";
})->name('notowner');

// Route::get('/articles',[
// 	'as'=>'article.index',
// 	'uses'=>'ArticlesController@index'
// ]);

// Route::get('/articles/create',[
// 	'middleware'=>'auth',
// 	'as'=>'article.create',
// 	'uses'=>'ArticlesController@create'
// ]);

// Route::post('/articles',[
// 	'middleware'=>'auth',
// 	'as'=>'article.store',
// 	'uses'=>'ArticlesController@store'
// ]);


// Route::get('/articles/{id}/edit',[
// 	'middleware'=>'auth',
// 	'middleware'=>'checkforowner',
// 	'as'=>'article.edit',
// 	'uses'=>'ArticlesController@edit'
// ]);
//

//
// Route::put('/articles/{id}',[
// 	'middleware'=>'auth',
// 	'middleware'=>'checkforowner',
// 	'as'=>'article.update',
// 	'uses'=>'ArticlesController@update'
// ]);

// Route::delete('articles/{id}',[
// 	'middleware'=>'auth',
// 	'middleware'=>'checkforowner',
// 	'as'=>'article.destroy',
// 	'uses'=>'ArticlesController@destroy'
// ]);

// Route::get('/articles/{id}',[
// 	'as'=>'article.show',
// 	'uses'=>'ArticlesController@show'
// ]);

// // Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// // Email Verification Routes...
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/', 'PagesController@index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home'); 
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['prefix'=>'/comment'],function(){
	Route::post('/{article_id}',[	
	'middleware'=>'auth',
	'uses'=>'CommentController@store',
	'as'=>'comment.store'
]);

Route::get('/{id}/edit',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'comment.edit',
	'uses'=>'CommentController@edit'
]);
    Route::put('/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
	'as'=>'comment.update',
	'uses'=>'CommentController@update'
]);

Route::delete('/{id}',[
	'middleware'=>'auth',
	'middleware'=>'checkforowner',
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