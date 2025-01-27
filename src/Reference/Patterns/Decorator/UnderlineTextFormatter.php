<?php

namespace App\Reference\Patterns\Decorator;

/**
 * クラス: UnderlineTextFormatter
 * テキストに下線を付けるデコレータ
 */
class UnderlineTextFormatter extends TextDecorator
{
  public function format(string $text): string
  {
    return "<u>" . parent::format($text) . "</u>";
  }
}
