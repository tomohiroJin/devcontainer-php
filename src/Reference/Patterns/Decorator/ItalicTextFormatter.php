<?php

namespace App\Reference\Patterns\Decorator;

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
