<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use java\lang\Object;

final class ObjectTest extends TestCase
{
    public function testCanInitializeObject() {
        $this->assertInstanceOf(
            java\lang\Object::class,
            new Object()
        );
    }
}

