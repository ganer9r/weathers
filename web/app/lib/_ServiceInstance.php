<?php
/**
 * Created by PhpStorm.
 * User: shim
 * Date: 15. 1. 8.
 * Time: 오후 10:06
 */

class _ServiceInstance {
	protected static $instances = [];

	public static function getInstance() {
		$name = get_called_class();

		if( !isset(self::$instances[$name]) ){
			self::$instances[$name] = new static();
		}

		return self::$instances[$name];
	}
}