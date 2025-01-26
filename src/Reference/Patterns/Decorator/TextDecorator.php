<?php

namespace App\Reference\Patterns\Decorator;

use App\Reference\Patterns\Decorator\TextFormatter;

/**
 * 抽象クラス: TextDecorator
 * すべてのデコレータクラスの基底クラス
 */
abstract class TextDecorator implements TextFormatter
{
  protected TextFormatter $formatter;

  public function __construct(TextFormatter $formatter)
  {
    $this->formatter = $formatter;
  }

  public function format(string $text): string
  {
    return $this->formatter->format($text);
  }
}
