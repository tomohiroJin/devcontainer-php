<?php

namespace App\Reference\Patterns\TemplateMethod;

/**
 * クラス: Designer
 * 
 * デザイナーのワークフローを実装する具体クラス
 */
class Designer extends AbstractWorker
{
  /**
   * デザイン作業を実装
   */
  protected function doMainTask(): string
  {
    return "Creating wireframes and UI designs.";
  }
}
