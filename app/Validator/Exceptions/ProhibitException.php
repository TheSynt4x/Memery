<?php
namespace App\Validator\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class ProhibitException extends ValidationException {
	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'That username is prohibited.',
		],
	];
}
