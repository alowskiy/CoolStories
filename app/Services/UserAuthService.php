<?php

namespace App\Services;

use App\Http\Data\UserDTO;
use App\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;

class UserAuthService
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($cred)
    {
        $userDTO = new UserDTO($cred['name'], $cred['email'], $cred['password']);
        $reg = $this->userRepository->registr($userDTO);

        return $userDTO->email;
    }

    public function login($cred)
    {
        if (\Auth::attempt(['email' => $cred['email'], 'password' => $cred['password']])) {
            $user = \Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $data = ['token' => $token, 'email' => $user['email']];

            return $data;
        } else {
            throw new AuthenticationException('Invalid credentials');
        }
    }

    public function updateUser($cred)
    {
        $user = \Auth::user();

        $userDTO = new UserDTO($cred['name'], $cred['email'], $cred['password']);
        if (\Gate::allows('update-user', $user)) {
            $this->userRepository->updateUser($userDTO);
            $userData[] = \Auth::user()->id;
            $userData[] = \Auth::user()->name;
            $userData[] = \Auth::user()->email;

            return $userData;
        } else {
            return 0;
        }
    }

    public function logOut()
    {
        $user = \Auth::user();
        $user->tokens()->delete();
    }
}
