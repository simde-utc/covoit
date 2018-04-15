<?php

namespace Model;

use App\DB;

class Ride extends Model
{
	public static function create($car_id, $description, $nb_free_seats, $value_luggage, $date, $creation_date, $user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return self::getDB()->request(
			"INSERT INTO ".static::getTableName()." VALUES (NULL,:user_id, :car_id, :description, :nb_free_seats, :value_luggage, :date, :creation_date);",
			[
				'user_id' => $user_id,
				'car_id' => $car_id,
				'description' => $description,
				'nb_free_seats' => $nb_free_seats,
				'value_luggage' => $value_luggage,
				'date' => $date,
				'creation_date' => $creation_date
			]
		);
	}

	public static function delete($ride_id, $user_id = null) {
		if ($user_id === null)
			$user_id = $_SESSION['id'];

		return self::getDB()->request(
			"DELETE FROM ".static::getTableName()." WHERE id = :ride_id AND user_id = :user_id",
			[
				'ride_id' => $ride_id,
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
