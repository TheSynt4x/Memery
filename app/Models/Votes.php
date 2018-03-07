<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;


class Votes extends Model {
    protected $fillable = [
        'post_id',
        'voted_by',
        'upvote',
        'downvote'
    ];

	public $timestamps = false;
}