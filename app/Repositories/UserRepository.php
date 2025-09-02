<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function registr($cred)
    {
        $user = new User();
        $user->name = $cred->name;
        $user->email = $cred->email;
        $user->password = \Hash::make($cred->password);
        $user->active = 1;
        $user->save();
    }

    public function updateUser($cred)
    {
        $user = \Auth::user();
        $user->name = $cred->name;
        $user->email = $cred->email;
        $user->password = \Hash::make($cred->password);

        $user->save();
    }
}
