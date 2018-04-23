<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use java\lang\StringBuffer;

final class StringBufferTest extends TestCase
{
    public function testInitializeStringBuffer() {
        $this->assertInstanceOf(
            java\lang\StringBuffer::class,
            new StringBuffer()
        );
    }

    public function testAppend() {
        $buffer = new StringBuffer("hello ");
        
        $this->assertEquals(
            "hello world!",
            $buffer->append("world!")
        );
    }    
}

