<?php
namespace App\Utils;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Database\Eloquent\Model;

trait ValidateRequest {
    public static function validateRequest($request, Model $model) {

        if (empty($request)) {
            throw new BadRequestException('Terdapat kesalahan pada request body (kosong)');
        }

        $rules = $model->validationRules();
        $messages = $model->validationMessages();

        $validator = Validator::make(
            $request, 
            $rules, 
            $messages
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public static function validateLoginWithAbilities($request) {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $validator = Validator::make(
            $request, 
            $rules, 
            $messages
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Custom ability di sini, bisa disesuaikan dengan kebutuhan
    }
}