<?php
/**
 * Created by PhpStorm.
 * User: shim
 * Date: 15. 3. 4.
 * Time: 오전 12:37
 */

namespace util;


use Illuminate\Support\Facades\DB;

class String {
	public static function db($field, $rename=''){
		if(!$rename)
			$rename = $field.'d';
		return DB::raw("(CASE WHEN {$field} = '0000-00-00 00:00:00' THEN '0000-00-00' ELSE {$field} END) AS {$rename}");
	}
}