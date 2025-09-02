<?php

namespace App\Http\Actions;

use App\Services\UserAuthService;

class LogoutUserAction
{
    public $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function execute()
    {
        $user = $this->userAuthService->logOut();
    }
}
