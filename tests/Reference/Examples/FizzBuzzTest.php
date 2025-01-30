<?php

declare(strict_types=1);

namespace Tests\Reference\Examples\FizzBuzz;

use PHPUnit\Framework\TestCase;
use App\Reference\Examples\FizzBuzz;

/**
 * クラス: FizzBuzzTest
 * 
 * FizzBuzz のテストクラス
 */
class FizzBuzzTest extends TestCase
{

  /**
   * 3と5の倍数以外の数値を渡した場合、その数値の文字列が返却されることを確認 
   */
  public function testReturnsNumberAsStringWhenNotMultipleOfThreeOrFive(): void
  {
    $fizzBuzz = new FizzBuzz();
    $this->assertSame("1", $fizzBuzz->fizzBuzz(1));
  }

  /**
   * 3 の倍数を渡した場合、文字列 "Fizz" が返却されることを確認
   */
  public function testFizzIsReturnedForMultiplesOfThree(): void
  {
    $fizzBuzz = new FizzBuzz();
    $this->assertSame("Fizz", $fizzBuzz->fizzBuzz(3));
  }

  /**
   * 5 の倍数を渡した場合、文字列 "Buzz" が返却されることを確認
   */
  public function testBuzzIsReturnedForMultiplesOfFive(): void
  {
    $fizzBuzz = new FizzBuzz();
    $this->assertSame("Buzz", $fizzBuzz->fizzBuzz(5));
  }

  /**
   * 15 の倍数を渡した場合、文字列 "FizzBuzz" が返却されることを確認
   */
  public function testFizzBuzzIsReturnedForMultiplesOfFifteen(): void
  {
    $fizzBuzz = new FizzBuzz();
    $this->assertSame("FizzBuzz", $fizzBuzz->fizzBuzz(15));
  }
}
