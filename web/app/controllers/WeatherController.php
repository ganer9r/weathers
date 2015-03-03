<?php


use util\String;

class WeatherController extends BaseController{

	public function getData(){
		$weather    = Weather::orderBy('updated_at', 'desc')->get(array('month', 'state', 'type', 'val', String::db('updated_at') ));
		$picture    = Picture::orderBy('updated_at', 'desc')->get(array('season', 'state', 'img', String::db('updated_at')));
		$message    = Message::orderBy('updated_at', 'desc')->get(array('season', 'state', 'ment', String::db('updated_at')));

		return Response::json(array(
			'weathers'   => $weather,
			'pictures'   => $picture,
			'messages'   => $message,
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