<?php

namespace Model;

class Passager extends Model
{
	public static function find($id) {
		return null;
	}

	public static function create($ride_id, $creation_date, $validated_at=null, $user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return self::getDB()->request(
			"INSERT INTO ".static::getTableName()." VALUES (:ride_id, :user_id, :creation_date, NULL);",
			[
				'ride_id' => $ride_id,
				'user_id' => $user_id,
				'creation_date' => $creation_date,
			]
		);
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

	public static function getJoinedFromUser($user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return static::getDB()->request(
			'SELECT r.* FROM rides r, passagers p WHERE p.user_id = :id and p.ride_id=r.id',
			[
				'id' => $user_id
			]
		);
	}


}
