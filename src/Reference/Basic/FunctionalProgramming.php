<?php

namespace App\Reference\Basic;

/**
 * クラス: FunctionalProgramming
 * 
 * PHPにおける関数型プログラミングの概念をまとめたクラス
 */
class FunctionalProgramming
{
  /**
   * 純粋関数: 2つの数値を足し合わせる
   * 
   * @param int $a
   * @param int $b
   * @return int
   */
  public function addNumbers(int $a, int $b): int
  {
    return $a + $b;
  }

  /**
   * 第一級関数: 関数を引数として渡して適用する
   * 
   * @param callable $func 関数
   * @param array $values 適用する数値の配列
   * @return array 関数を適用した結果の配列
   */
  public function applyFunction(callable $func, array $values): array
  {
    return array_map($func, $values);
  }

  /**
   * 無名関数（クロージャ）の使用例
   * 
   * @param int $factor 乗算の要素
   * @return callable 数値に適用するクロージャ関数
   */
  public function multiplier(int $factor): callable
  {
    return function ($number) use ($factor) {
      return $number * $factor;
    };
  }

  /**
   * 高階関数: 配列の偶数の合計を計算する
   * 
   * @param array $numbers 数値の配列
   * @return int 偶数の合計
   */
  public function sumEvenNumbers(array $numbers): int
  {
    $evenNumbers = array_filter($numbers, fn($n) => $n % 2 === 0);
    return array_reduce($evenNumbers, fn($carry, $item) => $carry + $item, 0);
  }

  /**
   * 再帰関数: 階乗を計算する
   * 
   * @param int $n 計算する数値
   * @return int 階乗の結果
   */
  public function factorial(int $n): int
  {
    return ($n === 0) ? 1 : $n * $this->factorial($n - 1);
  }
}
