<?php

namespace App\Reference\Patterns\TemplateMethod;

/**
 * クラス: Developer
 * 
 * ソフトウェアエンジニアのワークフローを実装する具体クラス
 */
class Developer extends AbstractWorker
{
  /**
   * コーディング作業を実装
   */
  protected function doMainTask(): string
  {
    return "Writing and debugging code.";
  }
}
