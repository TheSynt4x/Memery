<?php
namespace App\Validator\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class UserExists extends AbstractRule {
	public function validate($input) {
		return User::where('username', $input)->count() === 1;
	}
}