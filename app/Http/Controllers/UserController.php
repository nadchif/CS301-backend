<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|min:2',
            'contact_number' => 'required|string|min:2',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'contact_number' =>  $request->contact_number,
            ]);
            $user->sendEmailVerificationNotification();

            return response()->json(array(
                'data' => $user,
                'errors' => null,
            ), 201);
        } catch (\Exception $e) {
            $code = $e->getCode();
            return response()->json(array(
                'data' => false,
                'error' => $code == 23000 ? 'Cannot use email/username. Try another' : $e->getMessage(),

            ), $code == 23000 ? 409 : 500);
        }
    }

    public function profile()
    {
        $currentUser = Auth::user();

        $user = User::find($currentUser->id);

        return response()->json(array(
            'data' => $user,
            'error' => null,
        ), 200);
    }
}
