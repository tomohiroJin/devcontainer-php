<?php

declare(strict_types=1);

namespace Tests\Reference\Patterns\Decorator;

use PHPUnit\Framework\TestCase;
use App\Reference\Patterns\Decorator\PlainTextFormatter;
use App\Reference\Patterns\Decorator\BoldTextFormatter;
use App\Reference\Patterns\Decorator\ItalicTextFormatter;
use App\Reference\Patterns\Decorator\UnderlineTextFormatter;

/**
 * クラス: TextFormatterTest
 * 
 * TextFormatter デコレーターの単体テスト
 */
class TextFormatterTest extends TestCase
{
  /**
   * プレーンテキストのフォーマットのテスト
   */
  public function testPlainTextFormatter(): void
  {
    $formatter = new PlainTextFormatter();
    $this->assertSame("Hello, World!", $formatter->format("Hello, World!"));
  }

  /**
   * 太字フォーマットのテスト
   */
  public function testBoldTextFormatter(): void
  {
    $formatter = new BoldTextFormatter(new PlainTextFormatter());
    $this->assertSame("<b>Hello, World!</b>", $formatter->format("Hello, World!"));
  }

  /**
   * 斜体フォーマットのテスト
   */
  public function testItalicTextFormatter(): void
  {
    $formatter = new ItalicTextFormatter(new PlainTextFormatter());
    $this->assertSame("<i>Hello, World!</i>", $formatter->format("Hello, World!"));
  }

  /**
   * 下線フォーマットのテスト
   */
  public function testUnderlineTextFormatter(): void
  {
    $formatter = new UnderlineTextFormatter(new PlainTextFormatter());
    $this->assertSame("<u>Hello, World!</u>", $formatter->format("Hello, World!"));
  }

  /**
   * 複数のフォーマットの組み合わせのテスト
   */
  public function testCombinedFormatting(): void
  {
    $formatter = new BoldTextFormatter(
      new ItalicTextFormatter(
        new UnderlineTextFormatter(new PlainTextFormatter())
      )
    );
    $this->assertSame("<b><i><u>Hello, World!</u></i></b>", $formatter->format("Hello, World!"));
  }
}
