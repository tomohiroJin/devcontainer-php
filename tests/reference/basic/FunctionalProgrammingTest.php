<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\reference\basic\FunctionalProgramming;

/**
 * クラス: FunctionalProgrammingTest
 * 
 * FunctionalProgramming クラスの単体テスト
 */
class FunctionalProgrammingTest extends TestCase
{
  private FunctionalProgramming $functionalProgramming;

  protected function setUp(): void
  {
    $this->functionalProgramming = new FunctionalProgramming();
  }

  // 純粋関数テスト
  public function testAddNumbers(): void
  {
    $this->assertSame(7, $this->functionalProgramming->addNumbers(3, 4));
    $this->assertSame(0, $this->functionalProgramming->addNumbers(-5, 5));
  }

  // 第一級関数テスト
  public function testApplyFunction(): void
  {
    $square = fn($x) => $x * $x;
    $input = [1, 2, 3, 4];
    $expected = [1, 4, 9, 16];

    $this->assertSame($expected, $this->functionalProgramming->applyFunction($square, $input));
  }

  // 無名関数（クロージャ）テスト
  public function testMultiplier(): void
  {
    $double = $this->functionalProgramming->multiplier(2);
    $this->assertSame(10, $double(5));
    $this->assertSame(0, $double(0));
  }

  // 高階関数テスト
  public function testSumEvenNumbers(): void
  {
    $input = [1, 2, 3, 4, 5, 6];
    $this->assertSame(12, $this->functionalProgramming->sumEvenNumbers($input));

    $input = [1, 3, 5];
    $this->assertSame(0, $this->functionalProgramming->sumEvenNumbers($input));
  }

  // 再帰関数テスト
  public function testFactorial(): void
  {
    $this->assertSame(1, $this->functionalProgramming->factorial(0));
    $this->assertSame(1, $this->functionalProgramming->factorial(1));
    $this->assertSame(120, $this->functionalProgramming->factorial(5));
  }
}
