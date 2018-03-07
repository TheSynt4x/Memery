<?php
namespace App\Helpers;

class Mail {
    protected static function GetEmailContents() {
        return nl2br(file_get_contents('mail/content.html'));
    }

    public static function SendMail() {

    }
}