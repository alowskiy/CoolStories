<?php

namespace App\Services;

use Auth;
class UserService
{
        public function getCurrent()
    {
        $created = str(Auth::user()->created_at);
        $id = \Auth::user()->id;
        $email = \Auth::user()->email;
        $user = [$created, $id, $email];

        return $user;
    }
}