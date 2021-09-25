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
    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => 'string|min:2|nullable',
            'contact_number' => 'string|min:2|nullable',
            'old_password' => 'required_unless:password,null|string|nullable',
            'password' => 'string|nullable',
            'avatar_url' => 'string|nullable',
        ]);

        $currentUser = Auth::user();

        $result = User::find($currentUser->id);
        if ($result !== null) {
            $user = $result;

            if ($request->fullname != null) {
                $user->fullname = $request->fullname;
            }

            if ($request->contact_number != null) {
                $user->contact_number = $request->contact_number;
            }

            if ($request->avatar_url != null) {
                $user->avatar_url = $request->avatar_url;
            }

            $user->save();

            return response()->json(array(
                'data' => $user,
                'error' => null,
            ), 200);
        }
        return $this->handleEntryFindResponse($result);
    }
}
