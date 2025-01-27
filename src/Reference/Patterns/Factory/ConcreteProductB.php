<?php

namespace App\Reference\Patterns\Factory;

/**
 * クラス: ConcreteProductB
 * 製品Bの具体的な実装
 */
class ConcreteProductB implements ProductInterface
{
  public function getInfo(): string
  {
    return "This is Product B";
  }
}
