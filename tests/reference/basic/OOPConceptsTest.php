<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\reference\basic\OOPConcepts;
use App\reference\basic\DigitalProduct;
use App\reference\basic\PhysicalProduct;

/**
 * クラス: OOPConceptsTest
 * OOPConcepts クラスの単体テスト
 */
class OOPConceptsTest extends TestCase
{
  private DigitalProduct $digitalProduct;
  private PhysicalProduct $physicalProduct;

  protected function setUp(): void
  {
    $this->digitalProduct = OOPConcepts::createDigitalProduct("E-Book", 1500, 1000);
    $this->physicalProduct = OOPConcepts::createPhysicalProduct("Laptop", 120000, 2.5);
  }

  // デジタル商品の名前取得テスト
  public function testDigitalProductGetName(): void
  {
    $this->assertSame("E-Book", $this->digitalProduct->getName());
  }

  // 物理商品の名前取得テスト
  public function testPhysicalProductGetName(): void
  {
    $this->assertSame("Laptop", $this->physicalProduct->getName());
  }

  // デジタル商品の価格取得テスト
  public function testDigitalProductSummary(): void
  {
    $expected = "デジタル商品: E-Book, 価格: 1500 円, サイズ: 1000MB";
    $this->assertSame($expected, $this->digitalProduct->getSummary());
  }

  // 物理商品の価格取得テスト
  public function testPhysicalProductSummary(): void
  {
    $expected = "物理商品: Laptop, 価格: 120000 円, 重量: 2.5kg";
    $this->assertSame($expected, $this->physicalProduct->getSummary());
  }

  // デジタル商品のダウンロードサイズ取得テスト
  public function testDigitalProductDefaultSize(): void
  {
    $product = new DigitalProduct("Default Ebook", 1000);
    $this->assertSame(500, $product->getDownloadSize());
  }

  // 物理商品の重量取得テスト
  public function testPhysicalProductDefaultWeight(): void
  {
    $product = new PhysicalProduct("Smartphone", 80000);
    $this->assertSame(1.0, $product->getWeight());
  }
}
