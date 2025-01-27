<?php

namespace App\Reference\Patterns\Strategy;

/**
 * クラス: PayPalPayment
 * PayPal による支払いを処理する戦略
 */
class PayPalPayment implements PaymentStrategy
{
  private string $email;

  public function __construct(string $email)
  {
    $this->email = $email;
  }

  public function pay(float $amount): string
  {
    return "Paid {$amount} via PayPal ({$this->email}).";
  }
}
