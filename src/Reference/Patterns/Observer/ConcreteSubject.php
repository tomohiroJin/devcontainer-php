<?php

namespace App\Reference\Patterns\Observer;

/**
 * クラス: ConcreteSubject
 * 
 * 状態の変更を監視されるオブジェクト
 */
class ConcreteSubject implements SubjectInterface
{
  /**
   * @var array オブザーバーのリスト
   */
  private array $observers = [];

  /**
   * @var string サブジェクトの状態
   */
  private string $state;

  /**
   * オブザーバーを登録
   */
  public function attach(ObserverInterface $observer): void
  {
    $this->observers[] = $observer;
  }

  /**
   * オブザーバーを削除
   */
  public function detach(ObserverInterface $observer): void
  {
    $this->observers = array_filter(
      $this->observers,
      fn($obs) => $obs !== $observer
    );
  }

  /**
   * すべてのオブザーバーに通知
   */
  public function notify(): void
  {
    foreach ($this->observers as $observer) {
      $observer->update($this->state);
    }
  }

  /**
   * サブジェクトの状態を設定し、通知を送る
   */
  public function setState(string $state): void
  {
    $this->state = $state;
    $this->notify();
  }
}
