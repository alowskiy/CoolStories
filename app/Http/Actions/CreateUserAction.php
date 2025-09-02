<?php

namespace App\Http\Actions;

use App\Services\UserAuthService;

class CreateUserAction
{
    public $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function execute($cred)
    {
        $user = $this->userAuthService->register($cred);

        return $user;
    }
}
