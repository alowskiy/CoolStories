<?php

namespace App\Http\Actions;

use App\Services\UserAuthService;

class UpdateUserAction
{
    public $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function execute($cred)
    {
        $userData = $this->userAuthService->updateUser($cred);

        return $userData;
    }
}
