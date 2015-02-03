<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		#$user = User::find(1);
		#print_r($user->username);

		return View::make('home');
	}

	public function login()
	{
		$picture = Picture::max("updated_at");
		$message = Message::max("updated_at");
		$weather = Weather::max("updated_at");

		return Response::json(array(
			'picture'=> $picture,
			'message'=> $message,
			'weather'=> $weather,
		));
	}

	public function admin()
	{
		$path   = public_path().'/apps';
		$js    = $this->getDir($path);

		return View::make("admin", array('scripts'=>$js));
	}

	private function getDir($path)
	{
		$list = glob($path."/*");
		$files = array();
		foreach($list as $v){
			if(is_dir($v)){
				$files = array_merge($files, $this->getDir($v));
			}else{
				if(preg_match('@\.js$@', $v))
					$files[] = str_replace(public_path(), ".", $v);
			}
		}

		return $files;

	}

}
