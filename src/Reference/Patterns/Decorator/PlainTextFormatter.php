<?php

namespace App\Reference\Patterns\Decorator;

use App\Reference\Patterns\Decorator\TextFormatter;

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
