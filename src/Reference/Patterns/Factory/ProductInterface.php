<?php

namespace App\Reference\Patterns\Factory;

/**
 * インターフェイス: ProductInterface
 * すべての製品クラスが実装すべきメソッドを定義
 */
interface ProductInterface
{
  /**
   * 製品の情報を取得する
   * @return string
   */
  public function getInfo(): string;
}
