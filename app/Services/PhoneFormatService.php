<?php

namespace App\Services;

class PhoneFormatService
{
    public static function format($phoneNumber)
    {
        return preg_replace('/^\+1(\d{3})(\d{3})(\d{4})$/', '$1-$2-$3', $phoneNumber);
    }

    public static function formatNoCountryCode($phoneNumber)
    {
        return preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '$1-$2-$3', $phoneNumber);
    }
}
