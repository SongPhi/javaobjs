<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use java\lang\JString;

final class StringTest extends TestCase
{
    public function testCanInitializeString() {
        $this->assertEquals(
            "hello world!",
            (new JString("hello world!"))->toString()
        );
    }
}

