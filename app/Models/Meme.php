<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Meme extends Model {
    protected $fillable = [
        'title',
        'author',
        'date',
        'image',
        'description',
        'section',
        'points'
    ];

	public $timestamps = false;
}