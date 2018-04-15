<?php

namespace Model;

class Passager extends Model
{
	public static function find($id) {
		return null;
	}

	public static function get($ride_id, $user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		$thisTable = static::getTableName();

		return static::getDB()->request(
			'SELECT * FROM '.static::getTableName().' WHERE ride_id = :ride_id AND user_id = :user_id',
			[
				'ride_id' => $ride_id,
				'user_id' => $user_id,
			]
		);
	}

	public static function getFromRide($ride_id, $accepted = null) {
		$thisTable = static::getTableName();

		return static::getDB()->request(
			'SELECT * FROM '.static::getTableName().' WHERE ride_id = :id',
			[
				'id' => $ride_id
			]
		);
	}

	public static function getFromUser($user_id = null, $accepted = true) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return static::getDB()->request(
			'SELECT * FROM '.static::getTableName().' WHERE '.$thisTable.'.user_id = :id',
			[
				'id' => $user_id
			]
		);
	}
}
