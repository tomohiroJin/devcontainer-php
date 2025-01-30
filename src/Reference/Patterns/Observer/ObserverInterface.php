<?php

namespace App\Reference\Patterns\Observer;

/**
 * インターフェイス: ObserverInterface
 * 
 * オブザーバーパターンの通知先を定義するインターフェイス
 */
interface ObserverInterface
{
  /**
   * サブジェクトの状態変更時に通知を受け取るメソッド
   *
   * @param string $message
   */
  public function update(string $message): void;
}
