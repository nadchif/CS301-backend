<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $login_result = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$login_result) {
            return response()->json(array(
                'error' => 'invalid login credentials',
            ), 401);
        }

        $user = Auth::user();

        $token = $user->createToken('authToken')->accessToken;

        return response()->json(array(
            'user' => $user,
            // 'user' => $this->getStarterUserProfile($user),
            'access_token' => $token,
        ), 200);
    }
}
