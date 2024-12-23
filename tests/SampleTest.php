<?php

use PHPUnit\Framework\TestCase;
use App\Sample;

class SampleTest extends TestCase
{
  public function testAdd()
  {
    $sample = new Sample();
    $this->assertEquals(5, $sample->add(2, 3));
    $this->assertEquals(0, $sample->add(0, 0));
  }
}
