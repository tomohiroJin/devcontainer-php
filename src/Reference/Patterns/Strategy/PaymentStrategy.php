<?php

declare(strict_types=1);

namespace App\Reference\Patterns\Strategy;

/**
 * インターフェイス: PaymentStrategy
 * 支払い戦略の共通インターフェイス
 */
interface PaymentStrategy
{
    public function pay(float $amount): string;
}
