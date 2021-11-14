<?php

namespace App\Utils;

class SQLUtils
{
    public static function escapeLike(string $value, string $char = '\\'): array|string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char . $char, $char . '%', $char . '_'],
            $value
        );
    }
}
