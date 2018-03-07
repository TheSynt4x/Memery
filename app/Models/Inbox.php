<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Inbox extends Model {
    protected $fillable = [
        'from_user',
        'to_user',
        'subject',
        'message',
        'image',
        'date'
    ];


    public $table = 'inbox';

    public $timestamps = false;
}
