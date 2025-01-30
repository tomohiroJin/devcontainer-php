<?php

declare(strict_types=1);

namespace Tests\Reference\Patterns\Factory;

use PHPUnit\Framework\TestCase;
use App\Reference\Patterns\Factory\ProductFactory;
use App\Reference\Patterns\Factory\ConcreteProductA;
use App\Reference\Patterns\Factory\ConcreteProductB;
use App\Reference\Patterns\Factory\ProductInterface;

/**
 * クラス: ProductFactoryTest
 * 
 * Factory パターンの単体テスト
 */
class ProductFactoryTest extends TestCase
{
  /**
   * 製品Aのインスタンスが正しく生成されるかをテスト
   */
  public function testCreateProductA(): void
  {
    $product = ProductFactory::createProduct('A');
    $this->assertInstanceOf(ConcreteProductA::class, $product);
    $this->assertSame("This is Product A", $product->getInfo());
  }

  /**
   * 製品Bのインスタンスが正しく生成されるかをテスト
   */
  public function testCreateProductB(): void
  {
    $product = ProductFactory::createProduct('B');
    $this->assertInstanceOf(ConcreteProductB::class, $product);
    $this->assertSame("This is Product B", $product->getInfo());
  }

  /**
   * 無効な製品タイプが例外をスローするかをテスト
   */
  public function testInvalidProductType(): void
  {
    $this->expectException(\InvalidArgumentException::class);
    ProductFactory::createProduct('C');
  }
}
