<?php

declare(strict_types=1);

namespace App\Reference\Patterns\Decorator;

/**
 * クラス: PlainTextFormatter
 * 基本的なテキストフォーマッター
 */
class PlainTextFormatter implements TextFormatter
{
    public function format(string $text): string
    {
        return $text;
    }
}
