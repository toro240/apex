<?php

namespace App\Utils;

class SQLUtils
{
    /**
     * SQL LIKE 検索エスケープ処理
     * @param string $value
     * @return array|string
     */
    public static function escapeLike(string $value): array|string
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\' . '\\', '\\' . '%', '\\' . '_'],
            $value
        );
    }
}
