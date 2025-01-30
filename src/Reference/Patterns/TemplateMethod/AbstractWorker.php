<?php

namespace App\Reference\Patterns\TemplateMethod;

/**
 * 抽象クラス: AbstractWorker
 * 
 * Template Method パターンの基盤となる抽象クラス。
 * 仕事の流れ（ワークフロー）を定義し、一部の処理をサブクラスに委ねる。
 */
abstract class AbstractWorker
{
  /**
   * テンプレートメソッド: 仕事の流れを定義
   * 
   * 変更不可（final）とし、サブクラスで上書きできないようにする。
   */
  final public function work(): string
  {
    return implode("\n", [
      $this->startWork(),
      $this->doMainTask(),
      $this->endWork()
    ]);
  }

  /**
   * 作業の開始
   */
  protected function startWork(): string
  {
    return "Start working...";
  }

  /**
   * 主要タスク（具象クラスで実装）
   */
  abstract protected function doMainTask(): string;

  /**
   * 作業の終了
   */
  protected function endWork(): string
  {
    return "Finish work.";
  }
}
