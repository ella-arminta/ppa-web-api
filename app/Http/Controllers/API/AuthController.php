<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Utils\HttpResponse;
use App\Utils\AuthenticationUtil;
use App\Utils\HttpResponseCode;

use App\Utils\ValidateRequest;

class AuthController extends Controller
{
    use HttpResponse, ValidateRequest, AuthenticationUtil;

    public function login(Request $request)
    {
        $this->validateLogin($request->all());

        $abilities = ['abilities:tulis_sendiri_buat_admin_biasa_ya_ella'];

        if (isset($request->superAdmin) && (int)$request->superAdmin == 1) {
            $abilities = ['abilities:tulis_sendiri_buat_super_admin_ya_ella'];
        }

        $data = $this->createAuthToken(
            $request->email,
            $request->password,
            $abilities // Custom ability di sini, bisa disesuaikan
        );
        
        if(isset($data)) {
            return $this->success($data, HttpResponseCode::HTTP_OK);
        }

        return $this->error($data, HttpResponseCode::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request) {
        $data = $this->invalidateUser($request);

        if (isset($data[1]) && $data[1]) {
            return $this->success($data[0], HttpResponseCode::HTTP_OK);
        }

        return $this->error($data, HttpResponseCode::HTTP_UNAUTHORIZED);
    }
}
