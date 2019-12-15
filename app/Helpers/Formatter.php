<?php

namespace App\Helpers;

class Formatter
{
    const KEY_MAP = [
        "interface" => "network_interface",
    ];

    public static function cleanKey($keyString)
    {
        $cleaned = str_replace(['.'], '', $keyString);
        $cleaned = str_replace(['-'], '_', $cleaned);

        if (isset(static::KEY_MAP[$cleaned])) {
            $cleaned = static::KEY_MAP[$cleaned];
        }

        if (is_numeric($cleaned[0] ?? null)) {
            $cleaned = "_" . $cleaned;
        }

        return $cleaned;
    }
}
