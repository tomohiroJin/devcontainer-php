<?php

namespace App\Reference\Patterns\Observer;

/**
 * クラス: ConcreteObserver
 * 
 * サブジェクトから通知を受け取る具体的なオブザーバー
 */
class ConcreteObserver implements ObserverInterface
{
  /**
   * @var string 最新の通知内容
   */
  private string $latestMessage = '';

  /**
   * サブジェクトから通知を受け取る
   */
  public function update(string $message): void
  {
    $this->latestMessage = $message;
  }

  /**
   * 最新の通知内容を取得
   */
  public function getLatestMessage(): string
  {
    return $this->latestMessage;
  }
}
