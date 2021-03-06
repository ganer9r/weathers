<?php
/**
 * Created by PhpStorm.
 * User: shim
 * Date: 15. 1. 12.
 * Time: 오후 8:43
 */
namespace util;

class Net {
	private static function _call($url, $params=array(), $cnt=5){
		$ch = curl_init();
		if($params){
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
		$r  = curl_exec($ch);
		curl_close($ch);

		if(!$r && $cnt>0){
			$r = self::_call($url, $params, $cnt-1);
		}

		return $r;
	}

	public static function get($url, $param=array()){
		if($param){
			$url .= "?". http_build_query($param);
		}
		return self::_call($url);
	}
}