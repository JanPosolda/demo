<?php

declare(strict_types=1);

namespace App\Models;


/**
 * Class Helpers
 * @package App\Models
 */
class Helpers
{
	/**
	 * Salt and hash password
	 *
	 * @param string $password
	 * @param string $passwordSalt
	 * @return string
	 * @throws \Exception
	 */
	public static function preparePassword(string $password, string $passwordSalt): string
	{
		try {
			$saltedPassword = $passwordSalt . $password;

			return self::hashPassword($saltedPassword);
		} catch (\Exception $e) {
			throw $e;
		}
	}


	/**
	 * @param string $password
	 * @return string
	 */
	public static function hashPassword(string $password): string
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}
}
