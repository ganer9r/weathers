<?php

class AccountController extends BaseController{

	public function getSignIn(){
		return View::make('account.signin');
	}

	public function postSignIn(){
		$validator = Validator::make(Input::all(),
			array(
				'email'     => 'required|max:50|email',
				'password'  => 'required|min:6',
			)
		);

		if($validator->fails()){
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();
		}else{
			$remember = (Input::has('remember')) ? true : false;
			$auth = Auth::attempt(array(
				'email'     => Input::get('email'),
				'password'  => Input::get('password'),
				'active'    => 1,
			), $remember);

			if($auth){
				//Redirect to the intended page
				return Redirect::intended('/');
			}
		}

		return Redirect::route('account-sign-in')
				->with('global', 'There was a problem signing you in. Have you activated?');
	}

	public function getSignOut(){
		Auth::logout();
		return Redirect::route('home');
	}

	public function getCreate(){
		return View::make('account.create');
	}

	public function postCreate(){
		$validator = Validator::make(Input::all(),
			array(
				'email'             => 'required|max:50|email|unique:users',
				'username'          => 'required|max:20|min:3|unique:users',
				'password'          => 'required|min:6',
				'password_again'    => 'required|same:password',
			)
		);

		if($validator->fails()){
			return Redirect::route('account-create')
					->withErrors($validator)
					->withInput(Input::except('password', 'password_again'));
		} else {
			//Activation code;
			$code = str_random(60);

			$userdata = array(
				'email'     => Input::get('email'),
				'username'  => Input::get('username'),
				'password'  => Hash::make(Input::get('password')),
				'code'      => $code,
				'active'    => 0,
			);

			$user = User::create($userdata);
			if($user) {
				// send email
				Mail::send('emails.auth.activate', array(
					'link'=> URL::Route('account-activate', $code),
					'username'=>$user->username),
					function($message) use ($user) {
						$message->to($user->email, $user->username)->subject('Activate your account');
					}
				);

				return Redirect::route('home')
						->with('global', 'Your account has been created! We have sent you an email to activate your account');
			}
			die("OK");
		}

	}

	public function getActivate($code){
		$user = User::where('code', $code)->where('active', 0);
		if($user->count()){
			$user = $user->first();

			//update user to active state
			$user->active   = 1;
			$user->code     = '';
			if( $user->save() ){
				return Redirect::route('home')
						->with('global', 'Activated! You can now sign in!');
			}
		}

		return Redirect::route('home')
				->with('global', 'We could not activate your account. Try again later.');

	}

	public function getChangePassword(){
		return View::make('account.password');
	}

	public function postChangePassword(){
		$validator = Validator::make(Input::all(),
			array(
				'old_password'      => 'required|',
				'password'          => 'required|min:6',
				'password_again'    => 'required|same:password',
			)
		);

		if($validator->fails()){
			return Redirect::route("account-change-password")
					->withErrors($validator);
		}else{
			$user = User::find(Auth::user()->id);

			if(Hash::check(Input::get('old_password'), $user->password )){
				$user->password = hash::make(Input::get('password'));

				if($user->save()){
					return Redirect::route("home")
							->with('global', 'Your password has been changed!');
				}
			}
		}

		return Redirect::route('account-change-password')
				->with('global', 'Your password could not be changed.');
	}

	public function getForgotPassword(){
		return View::make("account.forgot");
	}

	public function postForgotPassword(){
		$validator  = Validator::make(Input::all(),array(
			'email' => 'required|email',
		));

		if($validator->fails()){
			return Redirect::route('account-forgot-password')
				->withErrors($validator)
				->withInput();
		}else{
			//change password
			$user = User::where('email', Input::get('email'));

			if($user->count()){
				$user = $user->first();

				$code       = str_random(60);
				$password   = str_random(10);

				$user->code = $code;
				$user->password_temp = Hash::make($password);

				if( $user->save() ){
					Mail::send('emails.auth.forgot', array(
						'name'      => $user->username,
						'url'       => URL::Route('account-recover', $code),
						'password'  => $password
					), function($message) use ($user){
						$message->to($user->email, $user->username)
							->subject('Your new password!');
					});

					return Redirect::route('home')
						->with('global','We have sent you a new password by email.');
				}
			}
		}

		return Redirect::route('account-forgot-password')
				->with('global', 'Could not request new Password!');
	}

	public function getRecover($code){
		$user = User::where('code',$code)->where('password_temp', '!=', '');

		if($user->count()){
			$user = $user->first();

			$user->password         = $user->password_temp;
			$user->password_temp    = '';
			$user->code             = '';

			if($user->save()){
				return Redirect::route('home')
					->with('global', 'Your accont has been recovered and you can sign in with your new password.' );
			}
		}

		return Redirect::route('home')
				->with('global', 'Could not recover your account.');
	}
}