<?php

namespace App\Validation;

use App\Models\UserModel;
use Exception;

class Userrules
{
	// public function custom_rule(): bool
	// {
	// 	return true;
	// }
	public function validateUser(string $str, string $fields, array $data)
	{
		try {
			$model = new UserModel();
			$user = $model->finduserByEmailAddress($data['email']);
			return password_verify($data['password'], $user['password']);
		} catch (Exception $e) {
			return false;
		}
	}
}
