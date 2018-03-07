<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model {
	protected $fillable = [
        'id',
		'username',
		'password',
		'email',
		'code',
		'activated',
		'ban'
	];

	public $timestamps = false;

	function isAdmin() {
		return $this->admin == 1;
	}

	function isBanned() {
		return $this->ban == 1;
	}
}
