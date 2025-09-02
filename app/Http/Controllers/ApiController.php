<?php

namespace App\Http\Controllers;

use App\Http\Actions\AuthUserAction;
use App\Http\Actions\CreateUserAction;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AuthRequest $authRequest)
    {
        $authUserAction = new AuthUserAction($authRequest);

        $user = $authUserAction->execute();

        return response()->json([
            'success' => true,
            'email' => $user['email'],
            'token' => $user['token'],
            'message' => 'Authentication successful',
        ], );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RegRequest $regRequest)
    {
        $val = $regRequest->validated();

        $createUserAction = new CreateUserAction($regRequest);
        $user = $createUserAction->execute();

        return response()->json([
            'success' => true,
            'message' => 'Registered successful. Authentication required.',
            'data' => [
                'email' => $user,
            ],
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
    }
}
