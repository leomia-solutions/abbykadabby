<?php

namespace App\Utilities;

class Str
{
    public static function lower($string)
    {
        return strtolower($string) ?? '';
    }
}
