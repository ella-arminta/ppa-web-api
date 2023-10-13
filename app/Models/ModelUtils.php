<?php

namespace App\Models;

class ModelUtils
{
    public static function filterNullValues(array $data): array
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }

    public static function checkParam($param)
    {
        return isset($param) && (int)$param == 1;
    }

    public static function rulesPatch($rules)
    {
        if (request()->isMethod('patch')) {
            foreach($rules as $key => $value) {
                if (str_contains($value, 'required')) {
                    $rules[$key] = str_replace('required', 'sometimes', $value);
                } else {
                    $rules[$key] = $value."|sometimes";
                }
            }
        }
        return $rules;
    }
}
