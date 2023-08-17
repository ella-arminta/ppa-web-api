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

        $rules = $model->rules();
        $messages = $model->messages();

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