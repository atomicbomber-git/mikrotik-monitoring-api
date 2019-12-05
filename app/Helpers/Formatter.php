<?php

namespace App\Helpers;

class Formatter
{
    public static function cleanKey($keyString)
    {
        $cleaned = str_replace(['.'], '', $keyString);
        $cleaned = str_replace(['-'], '_', $cleaned);
        return $cleaned;
    }
}
