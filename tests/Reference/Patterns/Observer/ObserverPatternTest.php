<?php

declare(strict_types=1);

namespace Tests\Reference\Patterns\Observer;

use PHPUnit\Framework\TestCase;
use App\Reference\Patterns\Observer\ConcreteSubject;
use App\Reference\Patterns\Observer\ConcreteObserver;

/**
 * クラス: ObserverPatternTest
 * 
 * Observer パターンのテスト
 */
class ObserverPatternTest extends TestCase
{
  /**
   * オブザーバーが通知を受け取ることを確認
   */
  public function testObserverReceivesUpdate(): void
  {
    $subject = new ConcreteSubject();
    $observer1 = new ConcreteObserver();
    $observer2 = new ConcreteObserver();

    $subject->attach($observer1);
    $subject->attach($observer2);

    $subject->setState("New state");

    $this->assertSame("New state", $observer1->getLatestMessage());
    $this->assertSame("New state", $observer2->getLatestMessage());
  }

  /**
   * オブザーバーが解除された後、通知を受け取らないことを確認
   */
  public function testObserverDoesNotReceiveUpdateAfterDetachment(): void
  {
    $subject = new ConcreteSubject();
    $observer = new ConcreteObserver();

    $subject->attach($observer);
    $subject->detach($observer);

    $subject->setState("Another state");

    $this->assertEmpty($observer->getLatestMessage());
  }
}
