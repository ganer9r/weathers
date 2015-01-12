<?php



class PictureController extends BaseController{

	public function getAll(){
		$list = Picture::get(array('season', 'state', 'img', 'size'))->all();

		return Response::json(array('pictures'=> $list));
	}

	public function set($id){
		if( Request::isMethod('POST') ){
			if($id){
				$model = Picture::find($id);
			}
			if(!$model)
				$model = new Picture;

			$model->ment = Input::get('ment');
			$model->month = Input::get('month');
			$model->save();

		}else if(Request::isMethod('DEMETE')){
			$model = Picture::find($id);
			if($model)
				$model->delete();
		}

		return true;
	}
}