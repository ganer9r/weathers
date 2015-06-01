<?php


use Illuminate\Support\Facades\Input;

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

			try {
				if (Input::hasFile('img')) {
					$file = Input::file('img');
					$ext = preg_Replace("@^(.*)\.@i", ".", $file->getClientOriginalName());
					$fileName = $model->season . '_' . time() . $ext;
					$path = storage_path() . "/files/pictures/";

					$file->move($path, $fileName);
					$model->img = './files/pictures/' . $fileName;
				}

			}catch(Exception $e){ print_r($e->getMessage());}

			$model->season  = Input::get('season', '');
			$model->state   = Input::get('state', '');
			$model->save();

		}else if(Request::isMethod('DELETE')){
			$model = Picture::find($id);

			if($model) {
				if($model->picasa_id)
					Laracasa::deletePhoto($model->picasa_id);

				$model->delete();
			}
		}

		return Response::json(true);
	}
}