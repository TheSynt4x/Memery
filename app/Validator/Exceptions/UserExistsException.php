<?php
namespace App\Validator\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class UserExistsException extends ValidationException {
	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'User does not exist.',
		],
	];
}