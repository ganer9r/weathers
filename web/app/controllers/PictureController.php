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


			try {
				$result = Laracasa::addPhoto($_FILES['img']);
				if ($result['state']) {
					if($model->picasa_id)
					Laracasa::deletePhoto($model->picasa_id);

					$pic = Laracasa::getPhotoById($result['id']);
					$picasa = $pic->getMediaGroup()->getContent()[0];

					$model->img = $picasa->getUrl();
					$model->picasa_id = $result['id'];
				}
			}catch(Exception $e){}

			$model->season  = Input::get('season', '');
			$model->state   = Input::get('state', '');
			$model->save();

		}else if(Request::isMethod('DEMETE')){
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