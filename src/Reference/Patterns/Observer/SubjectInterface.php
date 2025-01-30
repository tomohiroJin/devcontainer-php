<?php

namespace App\Reference\Patterns\Observer;

/**
 * インターフェイス: SubjectInterface
 * 
 * オブザーバーパターンの通知元を定義するインターフェイス
 */
interface SubjectInterface
{
  /**
   * オブザーバーを追加
   *
   * @param ObserverInterface $observer
   */
  public function attach(ObserverInterface $observer): void;

  /**
   * オブザーバーを削除
   *
   * @param ObserverInterface $observer
   */
  public function detach(ObserverInterface $observer): void;

  /**
   * すべてのオブザーバーへ通知を送信
   */
  public function notify(): void;
}
