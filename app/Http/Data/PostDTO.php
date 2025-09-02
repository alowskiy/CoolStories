<?php

namespace App\Http\Data;

class PostDTO
{
    public $text;
    public $title;
    public $user_id;

    public function __construct($txt, $ttl, $uid)
    {
        $this->text = $txt;
        $this->title = $ttl;
        $this->user_id = $uid;
    }
}
