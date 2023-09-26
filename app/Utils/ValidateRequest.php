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

    public static function validateLogin($request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
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
    }
}