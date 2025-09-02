<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function registr($cred);

    public function updateUser($cred);
}
