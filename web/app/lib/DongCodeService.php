<?php
/**
 * Created by PhpStorm.
 * User: shim
 * Date: 15. 1. 8.
 * Time: 오후 10:05
 */

class DongCodeService extends _ServiceInstance{
	public function getDongCode2Coords($lat, $lng)
	{
		$api = "http://apis.daum.net/local/geo/coord2addr";
		$param = array(
			'apikey' => '5ff68716227424826ae2888ad5ee8008ae1819af',
			'latitude' => $lat,
			'longitude' => $lng,
			'format' => 'fullName',
			'output' => 'json',
		);
		$url = $api . '?' . http_build_query($param);
		$addr = json_decode(file_get_contents($url));

		return $this->getDongCodeByAddress( str_replace(" ", "", $addr->fullName).'가나' );
	}

	private function getDongCodeByAddress($address){
		$data = DongCode::where('address_search', 'like', $address.'%')->first();
		if($data)
			return $data->code;
		else{
			if(mb_strlen($address) < 7)
				return '';

			$address = mb_substr($address, 0, -1);
			return $this->getDongCodeByAddress($address);
		}
	}


	public function setSyncCode(){
		DongCode::truncate();
		$top = file_get_contents("http://www.kma.go.kr/DFSROOT/POINT/DATA/top.json.txt");
		$top = json_decode($top);

		foreach($top as $v){
			$mdl = file_get_contents("http://www.kma.go.kr/DFSROOT/POINT/DATA/mdl.".$v->code.".json.txt");
			$mdl = json_decode($mdl);

			foreach($mdl as $vv){
				$leaf = file_get_contents("http://www.kma.go.kr/DFSROOT/POINT/DATA/leaf.".$vv->code.".json.txt");
				$leaf = json_decode($leaf);

				$this->save($leaf, $vv->value, $v->value);
			}
		}

		echo "dong code synchronize";
	}

	public function save($datas, $mdl, $top){
		foreach($datas as $v) {
			$code = new DongCode;

			$code->code     = $v->code;
			$code->address  = $top ." ". $mdl ." ". $v->value;
			$code->address_search  = $top . $mdl . $v->value;
			$code->save();
		}
	}
}