<?php

namespace App\Reference\Patterns\Decorator;

/**
 * インターフェイス: TextFormatter
 * すべてのフォーマットクラスが実装すべきインターフェイス
 */
interface TextFormatter
{
  /**
   * テキストをフォーマットする
   * 
   * @param string $text
   * @return string
   */
  public function format(string $text): string;
}
