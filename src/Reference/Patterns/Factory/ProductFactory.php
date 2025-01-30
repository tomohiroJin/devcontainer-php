<?php

namespace App\Reference\Patterns\Factory;

/**
 * クラス: ProductFactory
 * 製品オブジェクトの作成を担うファクトリクラス
 */
class ProductFactory
{
  /**
   * 製品の種類に応じたインスタンスを生成
   *
   * @param string $type 製品のタイプ（"A" または "B"）
   * @return ProductInterface
   * @throws \InvalidArgumentException
   */
  public static function createProduct(string $type): ProductInterface
  {
    return match ($type) {
      'A' => new ConcreteProductA(),
      'B' => new ConcreteProductB(),
      default => throw new \InvalidArgumentException("Unknown product type: $type"),
    };
  }
}
