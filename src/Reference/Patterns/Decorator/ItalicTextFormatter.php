<?php

namespace App\Reference\Patterns\Decorator;

use App\Reference\Patterns\Decorator\TextDecorator;

/**
 * クラス: ItalicTextFormatter
 * テキストを斜体にするデコレータ
 */
class ItalicTextFormatter extends TextDecorator
{
  public function format(string $text): string
  {
    return "<i>" . parent::format($text) . "</i>";
  }
}
