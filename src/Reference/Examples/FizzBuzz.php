<?php

namespace App\Reference\Examples;

/**
 * クラス: FizzBuzz
 * 
 * FizzBuzz問題の解答を生成するクラス
 */
class FizzBuzz
{
  public function fizzBuzz(int $number): string
  {
    if ($number % 15 === 0) {
      return "FizzBuzz";
    }
    if ($number % 3 === 0) {
      return "Fizz";
    }
    if ($number % 5 === 0) {
      return "Buzz";
    }
    return (string)$number;
  }
}
