<?php

namespace App\reference\basic;

class OOPConcepts
{
  public static function createDigitalProduct(string $name, float $price, int $downloadSize = 500): DigitalProduct
  {
    return new DigitalProduct($name, $price, $downloadSize);
  }

  public static function createPhysicalProduct(string $name, float $price, float $weight = 1.0): PhysicalProduct
  {
    return new PhysicalProduct($name, $price, $weight);
  }
}

/**
 * インターフェイス: ProductInterface
 * 商品の基本的な機能を提供する
 */
interface ProductInterface
{
  public function getName(): string;
  public function getPrice(): float;
  public function getSummary(): string;
}

/**
 * 抽象クラス: AbstractProduct
 * 商品の共通機能を提供
 */
abstract class AbstractProduct implements ProductInterface
{
  protected string $name;
  protected float $price;

  /**
   * コンストラクタ
   * @param string $name 商品名
   * @param float $price 価格
   */
  public function __construct(string $name, float $price)
  {
    $this->name = $name;
    $this->price = $price;
  }

  /**
   * 商品名を取得
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * 商品価格を取得
   */
  public function getPrice(): float
  {
    return $this->price;
  }

  /**
   * 抽象メソッド： 商品の概要を返す
   */
  abstract public function getSummary(): string;
}

/**
 * クラス: DigitalProduct
 * デジタル商品を表現し、AbstractProduct を継承
 */
class DigitalProduct extends AbstractProduct
{
  protected int $downloadSize;

  /**
   * コンストラクタ（オーバーロード的な実装）
   * @param string $name 商品名
   * @param float $price 価格
   * @param int $downloadSize ダウンロードサイズ (MB)
   */
  public function __construct(string $name, float $price, int $downloadSize = 500)
  {
    parent::__construct($name, $price);
    $this->downloadSize = $downloadSize;
  }

  /**
   * 商品の概要を返す（オーバーライド）
   */
  public function getSummary(): string
  {
    return "デジタル商品: {$this->name}, 価格: {$this->price} 円, サイズ: {$this->downloadSize}MB";
  }

  /**
   * ダウンロードサイズを取得
   */
  public function getDownloadSize(): int
  {
    return $this->downloadSize;
  }
}

/**
 * クラス: PhysicalProduct
 * 物理的な商品を表現し、AbstractProduct を継承
 */
class PhysicalProduct extends AbstractProduct
{
  protected float $weight;

  /**
   * コンストラクタ（オーバーロード的な実装）
   * @param string $name 商品名
   * @param float $price 価格
   * @param float $weight 重量 (kg)
   */
  public function __construct(string $name, float $price, float $weight = 1.0)
  {
    parent::__construct($name, $price);
    $this->weight = $weight;
  }

  /**
   * 商品の概要を返す（オーバーライド）
   */
  public function getSummary(): string
  {
    return "物理商品: {$this->name}, 価格: {$this->price} 円, 重量: {$this->weight}kg";
  }

  /**
   * 重量を取得
   */
  public function getWeight(): float
  {
    return $this->weight;
  }
}
