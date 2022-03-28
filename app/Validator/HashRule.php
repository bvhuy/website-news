<?php

namespace App\Validator;

use \Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class HashRule extends Validator
{
    public function validateHash($attribute, $value, $parameters)
    {
        return Hash::check($value, $parameters[0]);
    }
}
