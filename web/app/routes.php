<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use Illuminate\Support\Facades\Response;

Route::get('/', array(
	'as'    => 'home',
	'uses' => 'HomeController@index'
));

Route::get('/admin', array(
	'as'    => 'admin',
	'uses' => 'HomeController@admin'
));

Route::get('user/{username}', array(
	'as'    => 'profile-user',
	'uses'  => 'ProfileController@user',
));
/*
| Authenticated group
*/
Route::group(array('before'=>'auth'), function() {

	Route::group(array('before'=>'csrf'), function(){
		Route::post('/account/change-password', array(
			'as'    => 'account-change-password-post',
			'uses'  => 'AccountController@postChangePassword',
		));
	});
	/*
	 * Change password (GET)
	 */
	Route::get('/account/change-password', array(
		'as'    => 'account-change-password',
		'uses'  => 'AccountController@getChangePassword',
	));

	Route::get('account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut',
	));
});


/*
| Unauthenticated group
*/
Route::group(array('before'=>'guest'), function(){
	/*
	 * CSRF protection group
	 */
	Route::group(array('before'=>'csrf'), function(){
		Route::post('account/create', array(
			'as'    => 'account-create-post',
			'uses' => 'AccountController@postCreate',
		));

		Route::post('/account/sign-in', array(
			'as'    => 'account-sign-in-post',
			'uses'  => 'AccountController@postSignIn',
		));

		Route::post('/account/forgot-password', array(
			'as'    => 'account-forgot-password-post',
			'uses'  => 'AccountController@postForgotPassword'
		));
	});

	Route::get('/account/forgot-password', array(
		'as'    => 'account-forgot-password',
		'uses'  => 'AccountController@getForgotPassword'
	));

	Route::get('/account/recover/{code}', array(
		'as'    => 'account-recover',
		'uses'  => 'AccountController@getRecover',
	));

	Route::get('/account/sign-in', array(
		'as'    => 'account-sign-in',
		'uses'  => 'AccountController@getSignIn',
	));

	/*
	 * Create account (GET)
	 */
	Route::get('/account/create', array(
		'as'    => 'account-create',
		'uses'  => 'AccountController@getCreate',
	));

	Route::get('/account/activate/{code}', array(
		'as'    => 'account-activate',
		'uses'  => 'AccountController@getActivate',
	));

});

Route::get('/api/message', array(
	'uses'  => 'MessageController@getAll'
));
Route::post('/api/message/{id?}', array(
	'uses'  => 'MessageController@set'
));
Route::delete('/api/message/{id}', array(
	'uses'  => 'MessageController@set'
));

Route::get('/api/weather', array(
	'uses'  => 'WeatherController@getAll'
));
Route::post('/api/weather/{id?}', array(
	'uses'  => 'WeatherController@set'
));
Route::delete('/api/weather/{id}', array(
	'uses'  => 'MessageController@set'
));

Route::get('/api/picture', array(
	'uses'  => 'PictureController@getAll',
));
Route::post('/api/picture/{id?}', array(
	'uses'  => 'PictureController@set',
));
Route::delete('/api/picture/{id}', array(
	'uses'  => 'PictureController@set',
));


Route::get('/api/kma/test', function() {
	return Response::json(array(
		'code' => 'code',
		'name1' => '1',
		'name2' => '2',
		'name3' => '3',
	));
});
Route::get('/api/kma/codes', array(
	'uses'  => 'KmaController@getCodeAll'
));
Route::get('/api/kma/weather/{lat}/{lng}', array(
	'uses'  => 'KmaController@getWeather2Coords'
));
Route::get('/api/kma/weather/code/{code}', array(
	'uses'  => 'KmaController@getWeather2Code'
));

Route::get('/api/kma/syncCode', array(
	'uses'  => 'KmaController@setSyncCode'
));