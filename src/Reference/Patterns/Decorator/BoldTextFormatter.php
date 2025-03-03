<?php

namespace App\Reference\Patterns\Decorator;

/**
 * クラス: BoldTextFormatter
 * テキストを太字にするデコレータ
 */
class BoldTextFormatter extends TextDecorator
{
  public function format(string $text): string
  {
    return "<b>" . parent::format($text) . "</b>";
  }
}
