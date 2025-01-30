<?php

namespace App\Reference\Patterns\Strategy;

/**
 * クラス: BankTransferPayment
 * 銀行振込による支払いを処理する戦略
 */
class BankTransferPayment implements PaymentStrategy
{
  private string $bankAccount;

  public function __construct(string $bankAccount)
  {
    $this->bankAccount = $bankAccount;
  }

  public function pay(float $amount): string
  {
    return "Paid {$amount} via Bank Transfer ({$this->bankAccount}).";
  }
}
