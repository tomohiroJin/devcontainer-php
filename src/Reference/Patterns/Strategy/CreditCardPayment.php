<?php

namespace App\Reference\Patterns\Strategy;

/**
 * クラス: CreditCardPayment
 * クレジットカードによる支払いを処理する戦略
 */
class CreditCardPayment implements PaymentStrategy
{
  private string $cardNumber;
  private string $cardHolder;

  public function __construct(string $cardNumber, string $cardHolder)
  {
    $this->cardNumber = $cardNumber;
    $this->cardHolder = $cardHolder;
  }

  public function pay(float $amount): string
  {
    return "Paid {$amount} via Credit Card ({$this->cardHolder}, {$this->cardNumber}).";
  }
}
