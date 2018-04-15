<?php

namespace Model;

use App\DB;

class User extends Model {
	public static function findByLogin($login) {
		return static::getDB()->request(
			'SELECT * FROM '.static::getTableName().' WHERE login = :login',
			[
				'login' => $login
			],
			true
		);
	}

	public static function findOrCreate($login, $email, $lastname, $firstname) {
		$user = static::findByLogin($login);

		if (empty($user)) {
			static::getDB()->request(
				'INSERT INTO '.static::getTableName().'(email, login, lastname, firstname) VALUES(:email, :login, :lastname, :firstname)',
				[
					'email' => $email,
					'login' => $login,
					'lastname' => $lastname,
					'firstname' => $firstname,
				]
			);

			$user = static::findByLogin($login);
		}

		return $user;
	}
}
