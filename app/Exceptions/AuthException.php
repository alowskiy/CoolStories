<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthException extends \Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->json([
            'success' => false,
            'message' => 'Authentication error',
        ], 401);
    }
}
