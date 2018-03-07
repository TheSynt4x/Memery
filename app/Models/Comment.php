<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Comment extends Model {
    protected $fillable = [
        'post_id',
        'author',
        'date',
        'comment',
        'avatar'
    ];

    public $timestamps = false;
}
