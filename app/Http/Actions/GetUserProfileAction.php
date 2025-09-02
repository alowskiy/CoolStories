<?php

namespace App\Http\Actions;

use App\Services\UserService;

class GetUserProfileAction
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute()
    {
        $user = $this->userService->getCurrent();

        return $user;
    }
}
