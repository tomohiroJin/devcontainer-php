<?php

declare(strict_types=1);

namespace Tests\Reference\Patterns\TemplateMethod;

use PHPUnit\Framework\TestCase;
use App\Reference\Patterns\TemplateMethod\Developer;
use App\Reference\Patterns\TemplateMethod\Designer;

/**
 * クラス: TemplateMethodTest
 * 
 * Template Method パターンのテストクラス
 */
class TemplateMethodTest extends TestCase
{
  /**
   * Developer クラスのワークフローの動作確認
   */
  public function testDeveloperWorkflow(): void
  {
    $developer = new Developer();
    $expected = "Start working...\nWriting and debugging code.\nFinish work.";
    $this->assertSame($expected, $developer->work());
  }

  /**
   * Designer クラスのワークフローの動作確認
   */
  public function testDesignerWorkflow(): void
  {
    $designer = new Designer();
    $expected = "Start working...\nCreating wireframes and UI designs.\nFinish work.";
    $this->assertSame($expected, $designer->work());
  }
}
