<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\reference\basic\ControlStructures;

/**
 * クラス: ControlStructuresTest
 * 
 * ControlStructures クラスの単体テスト
 */
class ControlStructuresTest extends TestCase
{
  private ControlStructures $controlStructures;

  protected function setUp(): void
  {
    $this->controlStructures = new ControlStructures();
  }

  // 偶数・奇数の判定テスト（if-else -> 三項演算子）
  public function testCheckEvenOrOdd(): void
  {
    $this->assertSame("even", $this->controlStructures->checkEvenOrOdd(4));
    $this->assertSame("odd", $this->controlStructures->checkEvenOrOdd(7));
  }

  // 閏年の判定テスト（if-else -> 三項演算子）
  public function testIsLeapYear(): void
  {
    $this->assertTrue($this->controlStructures->isLeapYear(2024)); // 閏年
    $this->assertFalse($this->controlStructures->isLeapYear(2023)); // 非閏年
  }

  // 数値の正負ゼロ判定（switch -> 三項演算子）
  public function testCheckNumberSign(): void
  {
    $this->assertSame("positive", $this->controlStructures->checkNumberSign(5));
    $this->assertSame("negative", $this->controlStructures->checkNumberSign(-3));
    $this->assertSame("zero", $this->controlStructures->checkNumberSign(0));
  }

  // 配列内の各要素を2倍にするテスト（forループ）
  public function testDoubleArrayValues(): void
  {
    $input = [1, 2, 3];
    $expected = [2, 4, 6];
    $this->assertSame($expected, $this->controlStructures->doubleArrayValues($input));
  }

  // 偶数の合計テスト（foreachループ -> 三項演算子）
  public function testSumEvenNumbers(): void
  {
    $input = [1, 2, 3, 4, 5, 6];
    $this->assertSame(12, $this->controlStructures->sumEvenNumbers($input));
  }

  // メッセージの繰り返しテスト（whileループ）
  public function testRepeatMessage(): void
  {
    $expected = ["Hello", "Hello", "Hello"];
    $this->assertSame($expected, $this->controlStructures->repeatMessage("Hello", 3));
  }
}
