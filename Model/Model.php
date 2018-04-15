<?php

namespace Model;

use App\DB;

class Model {
	protected static $db;

	protected static function getDB() {
		if (static::$db === null)
			static::$db = new DB;

		return static::$db;
	}

	public static function getTableName() {
		$names = explode('\\', get_called_class());

		return isset(self::$table) ? self::$table : strtolower(end($names)).'s';
	}

	public static function find($id) {
		 return static::getDB()->request(
			 'SELECT * FROM '.static::getTableName().' WHERE id = :id',
			 [
				 'id' => $id
			 ],
			 true
		 );
	}
}
