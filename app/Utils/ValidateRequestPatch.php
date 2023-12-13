<?php
namespace App\Utils;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Database\Eloquent\Model;

trait ValidateRequestPatch {
    public static function validateRequestPatch($request, Model $model) {
        if (empty($request)) {
            throw new BadRequestException('Terdapat kesalahan pada request body (kosong)');
        }

        if(method_exists($model, 'validationRulesPatch') && $model->validationRulesPatch()) {
            $rules = $model->validationRulesPatch();
        }else{
            $rules = $model->validationRules();
        }
        
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
}