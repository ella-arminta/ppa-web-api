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
        $this->validateLoginWithAbilities($request->all());

        $data = $this->createAuthToken(
            $request->username,
            $request->password
        );

        if(isset($data['message'])){
            return $this->success($data, HttpResponseCode::HTTP_OK);
        }
        if(isset($data["token"])) {
            return $this->success($data, HttpResponseCode::HTTP_OK);
        }

        return $this->error($data, HttpResponseCode::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request) {
        $data = $this->invalidateUser($request);

        if (isset($data["loggedOut"]) && $data["loggedOut"]) {
            return $this->success($data["message"], HttpResponseCode::HTTP_OK);
        }

        return $this->error($data, 401);
    }
}
