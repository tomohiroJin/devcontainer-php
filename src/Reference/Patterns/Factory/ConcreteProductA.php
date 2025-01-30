<?php

namespace App\Reference\Patterns\Factory;

/**
 * クラス: ConcreteProductA
 * 製品Aの具体的な実装
 */
class ConcreteProductA implements ProductInterface
{
  public function getInfo(): string
  {
    return "This is Product A";
  }
}
