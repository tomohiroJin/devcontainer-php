<?php

namespace App\reference\basic;

/**
 * クラス: ControlStructures
 * 
 * 制御構文（条件分岐・ループ文）に関する実装をまとめたクラスです。
 */
class ControlStructures
{
  /**
   * 与えられた数値が偶数か奇数かを判定する（if-else 使用）
   * 
   * @param int $number チェック対象の数値
   * @return string "even" か "odd" を返す
   */
  public function checkEvenOrOdd(int $number): string
  {
    return ($number % 2 === 0) ? "even" : "odd";  // 三項演算子を使用
  }

  /**
   * 与えられた年が閏年かどうかを判定する（if-else 使用）
   * 
   * @param int $year チェック対象の年
   * @return bool 閏年なら true, そうでなければ false
   */
  public function isLeapYear(int $year): bool
  {
    return ($year % 400 === 0 || ($year % 4 === 0 && $year % 100 !== 0)) ? true : false;
  }

  /**
   * 与えられた数値が正・負・ゼロのどれかを判定する（switch 使用）
   * 
   * @param int $number チェック対象の数値
   * @return string "positive", "negative", "zero" を返す
   */
  public function checkNumberSign(int $number): string
  {
    return ($number > 0) ? "positive" : (($number < 0) ? "negative" : "zero");
  }

  /**
   * 配列内の各要素を2倍にする（forループを使用）
   * 
   * @param array $numbers 入力配列
   * @return array 値を2倍にした配列
   */
  public function doubleArrayValues(array $numbers): array
  {
    $result = [];
    for ($i = 0; $i < count($numbers); $i++) {
      $result[] = $numbers[$i] * 2;
    }
    return $result;
  }

  /**
   * 配列内の偶数の合計を計算する（foreachループを使用）
   * 
   * @param array $numbers 数値の配列
   * @return int 偶数の合計値
   */
  public function sumEvenNumbers(array $numbers): int
  {
    $sum = 0;
    foreach ($numbers as $num) {
      $sum += ($num % 2 === 0) ? $num : 0; // 三項演算子を使用
    }
    return $sum;
  }

  /**
   * 指定された回数の繰り返しメッセージを生成（whileループを使用）
   * 
   * @param string $message メッセージ
   * @param int $times 繰り返し回数
   * @return array 繰り返したメッセージの配列
   */
  public function repeatMessage(string $message, int $times): array
  {
    $result = [];
    $count = 0;
    while ($count < $times) {
      $result[] = $message;
      $count++;
    }
    return $result;
  }
}
