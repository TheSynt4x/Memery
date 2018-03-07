<?php
namespace App\Validator\Rules;

use Respect\Validation\Rules\AbstractRule;

class Prohibit extends AbstractRule {
    protected $words = [
        'nigger',
        'faggot',
        'homosexual',
        'cunt',
        'fuck',
        'jew',
        'muslim'
    ];

	public function validate($input) {
        foreach($this->words as $word) {
            return (strpos($input, $word) === false);
        }
	}
}
