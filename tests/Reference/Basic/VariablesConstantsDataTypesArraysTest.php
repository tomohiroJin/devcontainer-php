<?php

use PHPUnit\Framework\TestCase;
use App\Reference\Basic\VariablesConstantsDataTypesArrays;


/**
 * クラス: VariablesConstantsDataTypesArraysTest
 * 
 * VariablesConstantsDataTypesArrays クラスの単体テスト
 */
class VariablesConstantsDataTypesArraysTest extends TestCase
{
  private VariablesConstantsDataTypesArrays $instance;

  protected function setUp(): void
  {
    $this->instance = new VariablesConstantsDataTypesArrays();
  }

  // 整数のテスト
  public function testGetIntValue(): void
  {
    $this->assertSame(42, $this->instance->getIntValue());
  }

  // 浮動小数点のテスト
  public function testGetFloatValue(): void
  {
    $this->assertSame(3.14, $this->instance->getFloatValue());
  }

  // 文字列のテスト
  public function testGetStringValue(): void
  {
    $this->assertSame("Hello, PHP!", $this->instance->getStringValue());
  }

  // 真偽値のテスト
  public function testGetBoolValue(): void
  {
    $this->assertTrue($this->instance->getBoolValue());
  }

  // 配列のテスト
  public function testGetArrayValue(): void
  {
    $this->assertSame(["apple", "banana", "cherry"], $this->instance->getArrayValue());
  }

  // 配列への要素追加テスト
  public function testAddToArray(): void
  {
    $this->instance->addToArray("grape");
    $this->assertSame(["apple", "banana", "cherry", "grape"], $this->instance->getArrayValue());
  }

  // 配列のサイズ取得テスト
  public function testGetArraySize(): void
  {
    $this->instance->addToArray("mango");
    $this->assertSame(4, $this->instance->getArraySize());
  }

  // 定数のテスト
  public function testGetSiteName(): void
  {
    $this->assertSame("PHP Learning", $this->instance->getSiteName());
  }
}
