<?php namespace App\Validation;

class CustomRules
{
    public function valid_phone(string $str, string &$error = null): bool
    {
        if (preg_match('/^[0-9]{10}$/', $str)) {
            return true;
        }

        $error = 'The {field} field must be a valid phone number.';
        return false;
    }
}