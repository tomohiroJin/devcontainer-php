<?php

declare(strict_types=1);

namespace Tests;

use App\Sample;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function testAdd(): void
    {
        $sample = new Sample();
        $this->assertSame(5, $sample->add(2, 3));
        $this->assertSame(0, $sample->add(0, 0));
    }
}
