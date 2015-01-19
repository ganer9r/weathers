<?php



class PictureController extends BaseController{

	public function getAll(){
		$list = Picture::get()->all();
		$last_date = Weather::max('updated_at');

		return Response::json(array('picture_date'=>$last_date, 'pictures'=> $list));
	}

	public function set($id=''){
		if( Request::isMethod('POST') ){
			if($id){
				$model = Picture::find($id);
			}
			if(!isset($model))
				$model = new Picture;

			$model->season  = Input::get('season', '');
			$model->state   = Input::get('state', '');
			$model->img     = Input::get('img', '');
			$model->save();

		}else if(Request::isMethod('DEMETE')){
			$model = Picture::find($id);
			if($model)
				$model->delete();
		}

		return Response::json(true);
	}
}