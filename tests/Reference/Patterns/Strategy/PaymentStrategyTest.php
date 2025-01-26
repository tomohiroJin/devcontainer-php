<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Reference\Patterns\Strategy\PaymentContext;
use App\Reference\Patterns\Strategy\CreditCardPayment;
use App\Reference\Patterns\Strategy\PayPalPayment;
use App\Reference\Patterns\Strategy\BankTransferPayment;

/**
 * クラス: PaymentStrategyTest
 * 
 * Strategyパターンのテストクラス
 */
class PaymentStrategyTest extends TestCase
{
  private PaymentContext $paymentContext;

  protected function setUp(): void
  {
    $this->paymentContext = new PaymentContext();
  }

  /**
   * クレジットカードでの支払いテスト
   */
  public function testCreditCardPayment(): void
  {
    $strategy = new CreditCardPayment("1234-5678-9876-5432", "Alice Johnson");
    $this->paymentContext->setPaymentStrategy($strategy);
    $result = $this->paymentContext->executePayment(100.50);
    $this->assertSame("Paid 100.5 via Credit Card (Alice Johnson, 1234-5678-9876-5432).", $result);
  }

  /**
   * PayPalでの支払いテスト
   */
  public function testPayPalPayment(): void
  {
    $strategy = new PayPalPayment("alice@example.com");
    $this->paymentContext->setPaymentStrategy($strategy);
    $result = $this->paymentContext->executePayment(250.00);
    $this->assertSame("Paid 250 via PayPal (alice@example.com).", $result);
  }

  /**
   * 銀行振込での支払いテスト
   */
  public function testBankTransferPayment(): void
  {
    $strategy = new BankTransferPayment("987654321");
    $this->paymentContext->setPaymentStrategy($strategy);
    $result = $this->paymentContext->executePayment(500.75);
    $this->assertSame("Paid 500.75 via Bank Transfer (987654321).", $result);
  }

  /**
   * 支払いストラテジが設定されていない場合に例外が発生することをテスト
   */
  public function testPaymentWithoutStrategyThrowsException(): void
  {
    $this->expectException(\RuntimeException::class);
    $this->paymentContext->executePayment(100);
  }
}
