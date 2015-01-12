<?php
use util\Net;

/**
 * Created by PhpStorm.
 * User: shim
 * Date: 15. 1. 8.
 * Time: 오후 10:08
 */

class WeatherService extends _ServiceInstance{
	public function getWeather($code){
		//이거 캐싱해야해...

		$url    = "http://www.kma.go.kr/wid/queryDFSRSS.jsp?zone=".$code;
		$xml    = Net::get($url);
		$xml    = new SimpleXmlElement($xml);
		$weather    = $xml->channel->item;

		$items  = array();
		foreach($weather->description->body->data as $item){
			$item = (array)$item;
			unset($item['@attributes']);

			$items[]    = $item;
		}

		return array(
			'address'   => (string)$weather->category,
			'ymdh'      => (string)$weather->description->header->tm,
			'items'     => $items
		);
	}
}