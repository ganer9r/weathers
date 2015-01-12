<?php



class WeatherController extends BaseController{

	public function getAll(){
		$list = Weather::get(array('month', 'state', 'type', 'val'))->all();

		return Response::json(array('weathers'=> $list));
	}

	public function set($id){
		if( Request::isMethod('POST') ){
			if($id){
				$model = Weather::find($id);
			}
			if(!$model)
				$model = new Weather;

			$model->ment = Input::get('ment');
			$model->month = Input::get('month');
			$model->save();

		}else if(Request::isMethod('DEMETE')){
			$model = Weather::find($id);
			if($model)
				$model->delete();
		}

		return true;
	}
}