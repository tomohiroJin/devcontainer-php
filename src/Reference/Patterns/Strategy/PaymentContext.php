<?php

namespace App\Reference\Patterns\Strategy;

/**
 * クラス: PaymentContext
 * 支払い処理を実行するコンテキストクラス
 */
class PaymentContext
{
  private PaymentStrategy $paymentStrategy;

  /**
   * 支払い戦略を設定する
   * 
   * @param PaymentStrategy $strategy
   */
  public function setPaymentStrategy(PaymentStrategy $strategy): void
  {
    $this->paymentStrategy = $strategy;
  }

  /**
   * 支払いを実行する
   * 
   * @param float $amount
   * @return string
   */
  public function executePayment(float $amount): string
  {
    if (!isset($this->paymentStrategy)) {
      throw new \RuntimeException("Payment strategy is not set.");
    }

    return $this->paymentStrategy->pay($amount);
  }
}
