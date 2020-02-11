<?php

namespace App\Constants;

class UserLevel
{
    const ADMINISTRATOR = "ADMINISTRATOR";
    const SUPER_ADMINISTRATOR = "SUPER_ADMINISTRATOR";

    const LEVELS = [
        self::ADMINISTRATOR => "Administrator",
        self::SUPER_ADMINISTRATOR => "Super Administrator",
    ];
}
