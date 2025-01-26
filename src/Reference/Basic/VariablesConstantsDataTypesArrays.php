<?php

namespace App\Reference\Basic;

/**
 * クラス: VariablesConstantsDataTypesArrays
 * 
 * PHPの変数、定数、データ型、配列の基本的な使い方を学ぶためのクラスです。
 */
class VariablesConstantsDataTypesArrays
{
  // 定数の宣言
  public const PI = 3.14159;
  public const SITE_NAME = 'PHP Learning';

  // プロパティ（メンバー変数）
  private string $stringValue;
  private int $intValue;
  private float $floatValue;
  private bool $boolValue;
  private array $arrayValue;

  /**
   * コンストラクタ
   * 各種データ型の初期値を設定します。
   */
  public function __construct()
  {
    $this->stringValue = "Hello, PHP!";
    $this->intValue = 42;
    $this->floatValue = 3.14;
    $this->boolValue = true;
    $this->arrayValue = ["apple", "banana", "cherry"];
  }

  // 変数の操作に関するメソッド

  /**
   * 整数の取得
   * @return int
   */
  public function getIntValue(): int
  {
    return $this->intValue;
  }

  /**
   * 浮動小数点の取得
   * @return float
   */
  public function getFloatValue(): float
  {
    return $this->floatValue;
  }

  /**
   * 文字列の取得
   * @return string
   */
  public function getStringValue(): string
  {
    return $this->stringValue;
  }

  /**
   * 真偽値の取得
   * @return bool
   */
  public function getBoolValue(): bool
  {
    return $this->boolValue;
  }

  /**
   * 配列の取得
   * @return array
   */
  public function getArrayValue(): array
  {
    return $this->arrayValue;
  }

  /**
   * 配列に要素を追加
   * @param string $item 追加するアイテム
   * @return void
   */
  public function addToArray(string $item): void
  {
    $this->arrayValue[] = $item;
  }

  /**
   * 配列のサイズを取得
   * @return int
   */
  public function getArraySize(): int
  {
    return count($this->arrayValue);
  }

  /**
   * 定数の取得
   * @return string
   */
  public function getSiteName(): string
  {
    return self::SITE_NAME;
  }
}
