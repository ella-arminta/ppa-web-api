<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

trait AuthenticationUtil
{
    public static function createAuthToken(
        $email,
        $password,
        $abilities = ['*']
    ) {
        if (Auth::attempt(
            [
                'email' => $email,
                'password' => $password
            ]
        )) {
            $user = Auth::user();

            $success['token'] = $user->createToken($user->name, $abilities)->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            // $success['name'] = $user->name;

            return $success;
        }

        return "Email atau password salah";
    }

    public static function invalidateUser(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }

        return [
            'User berhasil logout!',
            true
        ];
    }
}
