<?php



class WeatherController extends BaseController{

	public function getData(){
		$weather    = Weather::get(array('month', 'state', 'type', 'val'));
		$picture    = Picture::get(array('season', 'state', 'img'));
		$message    = Message::get(array('season', 'state', 'ment'));

		return Response::json(array(
			'weather'   => $weather,
			'picture'   => $picture,
			'message'   => $message,
		));
	}

	public function getAll(){
		$list = Weather::get()->all();
		$last_date = Weather::max('updated_at');

		return Response::json(array('weather_date'=>$last_date, 'weathers'=> $list));
	}

	public function set($id=''){
		if( Request::isMethod('POST') ){
			if($id){
				$model = Weather::find($id);
			}
			if(!isSet($model))
				$model = new Weather;

			$model->month   = Input::get('month', '');
			$model->state   = Input::get('state', '');
			$model->type    = Input::get('type', '');
			$model->val     = Input::get('val', '');
			$model->save();


		}else if(Request::isMethod('DEMETE')){
			$model = Weather::find($id);
			if($model)
				$model->delete();
		}

		return Response::json(true);
	}
}