<?php declare(strict_types=1);

namespace App\Domain;

final class UserRowHeader
{
    private const EOF = "\n";
    private const HEADER = [
        '名前',
        'メールアドレス',
        '作成日',
        '更新日',
    ];

    public static function toCsv(): string
    {
        return implode(',', self::HEADER) . self::EOF;
    }
}
