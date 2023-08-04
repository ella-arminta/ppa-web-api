<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()
            ], 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('saya_tampan')->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        // $success['name'] = $user->name;

        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil!',
            'data' => $success,
        ]);
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()
            ], 400);
        }

        // dd(Auth::attempt(['email' => $request->email, 'password' => $request->password]));
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            // $success['name'] = $user->name;

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil!',
                'data' => $success,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Kredensial salah!',
            'data' => null,
        ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        // $user;
        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil logout!',
            'data' => $request->user(),
        ], 200);
    }
}
