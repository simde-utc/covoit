<?php

namespace Model;

use App\DB;

class Car extends Model
{
	public static function create($model, $color, $nb_seats, $user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return self::getDB()->request(
			"INSERT INTO ".static::getTableName()." VALUES (NULL,:user_id, :model, :color, :nb_seats);",
			[
				'user_id' => $user_id,
				'model' => $model,
				'color' => $color,
				'nb_seats' => $nb_seats,
			]
		);
	}

	public static function delete($car_id, $user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return self::getDB()->request(
			"DELETE FROM ".static::getTableName()." WHERE id = :car_id AND user_id = :user_id",
			[
				'car_id' => $car_id,
				'user_id' => $user_id,
			]
		);
	}

	public static function getFromUser($user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return static::getDB()->request(
			'SELECT * FROM '.static::getTableName().' WHERE user_id = :id',
			[
				'id' => $user_id
			]
		);
	}
}
