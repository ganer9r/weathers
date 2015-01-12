<?php



class MessageController extends BaseController{

	public function getAll(){
		$messages = Message::get()->all();

		return Response::json($messages);
	}

	public function set($id=0){
		if( Request::isMethod('POST') ){
			if($id){
				$message = Message::find($id);
			}
			if(!isSet($message) || !$message)
				$message = new Message;

			$message->ment = Input::get('ment');
			$message->month = Input::get('month');
			$message->save();

		}else if(Request::isMethod('DELETE')){
			$message = Message::find($id);
			if($message)
				$message->delete();
		}
	}
}