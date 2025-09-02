<?php

namespace App\Http\Controllers;

use App\Http\Actions\AuthUserAction;
use App\Http\Actions\CreateUserAction;
use App\Http\Actions\GetUserProfileAction;
use App\Http\Actions\LogoutUserAction;
use App\Http\Actions\UpdateUserAction;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegRequest;
use App\Http\Requests\UpdateRequest;

class AuthController extends Controller
{
    public $createUserAction;
    public $authUserAction;
    public $getUserProfileAction;
    public $updateUserAction;
    public $logoutUserAction;

    public function __construct(CreateUserAction $createUserAction, AuthUserAction $authUserAction, GetUserProfileAction $getUserProfileAction, UpdateUserAction $updateUserAction, LogoutUserAction $logoutUserAction)
    {
        $this->createUserAction = $createUserAction;
        $this->authUserAction = $authUserAction;
        $this->getUserProfileAction = $getUserProfileAction;
        $this->updateUserAction = $updateUserAction;
        $this->logoutUserAction = $logoutUserAction;
    }

    public function register(RegRequest $regRequest)
    {
        $cred = $regRequest->validated();
        $user = $this->createUserAction->execute($cred);

        return response()->json([
            'success' => true,
            'message' => 'Registered successful. Authentication required.',
            'data' => [
                'email' => $user,
            ],
        ], 201);
    }

    public function login(AuthRequest $authRequest)
    {
        $cred = $authRequest->validated();
        $user = $this->authUserAction->execute($cred);

        return response()->json([
            'success' => true,
            'email' => $user['email'],
            'token' => $user['token'],
            'message' => 'Authentication successful',
        ], );
    }

    public function currentUser()
    {
        $user = $this->getUserProfileAction->execute();

        return response()->json([
            'created_at' => $user[0],
            'id' => $user[1],
            'email' => $user[2],
        ]);
    }

    public function updateCurrentUser(UpdateRequest $updateRequest)
    {
        $cred = $updateRequest->validated();
        $updateData = $this->updateUserAction->execute($cred);

        if ($updateData) {
            return response()->json([
                'success' => true,
                'message' => 'User data was updated',
                'data' => [
                    'id' => $updateData[0],
                    'name' => $updateData[1],
                    'email' => $updateData[2],
                ],
            ]);
        }
    }

    public function logout()
    {
        $this->logoutUserAction->execute();

        return response()->json([
            'success' => true,
            'message' => 'Log out successful',
        ]);
    }
}
