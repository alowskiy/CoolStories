<?php

namespace App\Http\Actions;

use App\Services\UserAuthService;

class AuthUserAction
{
    public $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function execute($cred)
    {
        $user = $this->userAuthService->login($cred);

        return $user;
    }
}
