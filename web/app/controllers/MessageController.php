<?php



class MessageController extends BaseController{

	public function getAll(){
		$list = Message::get(array('month', 'ment'))->all();
		$last_date = Weather::max('updated_at');

		return Response::json(array('message_date'=> $last_date, 'messages'=> $list));
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