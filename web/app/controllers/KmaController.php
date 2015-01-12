<?php
use Illuminate\Support\Facades\Response;

/**
 * Created by PhpStorm.
 * User: shim
 * Date: 15. 1. 8.
 * Time: 오후 9:56
 */

class KmaController extends BaseController {

	public function getCodeAll(){
		$codes   = Dong::all();

		return $codes;
	}

	public function getWeather2Coords($lat, $lng){
		$dongCode   = DongCodeService::getInstance()->getDongCode2Coords($lat, $lng);
		$weather    = WeatherService::getInstance()->getWeather($dongCode);


		return Response::json(array(
			'latlng'=> array('lat'=>$lat, 'lng'=>$lng),
			'dong'=> $dongCode,
			'weather'=> $weather
		));
	}

	public function getWeather2Code($code){
		$weather    = Weather::getInstance()->getWeather($code);

		return Response::json(array('dong'=> $code, 'weather'=> $weather));
	}

	public function setSyncCode(){
		DongCodeService::getInstance()->setSyncCode();
	}
}