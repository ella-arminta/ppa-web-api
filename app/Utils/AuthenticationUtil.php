<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

trait AuthenticationUtil
{
    public static function createAuthToken(
        $username,
        $password,
        $abilities = ['noaccess']
    ) {
        if (Auth::attempt(
            [
                'username' => $username,
                'password' => $password
            ]
        )) {
            $user = Auth::user();
            
            if($user->role->nama == 'kelurahan'){
                $abilities = ['superadmin'];
            }else if($user->role->nama == 'satgas'){
                $abilities = ['admin'];
            }

            $success['token'] = $user->createToken($user->nama, $abilities)->plainTextToken;
            $success['id'] = $user->id;
            $success['name'] = $user->nama;
            $success['username'] = $user->username;
            $success['role'] = $user->role->nama;

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
            'message' => 'User berhasil logout!',
            'loggedOut' => true
        ];
    }
}
