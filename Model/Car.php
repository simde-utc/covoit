<?php

namespace Model;

class Car extends Model
{
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
