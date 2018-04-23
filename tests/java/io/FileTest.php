<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FileTest extends TestCase
{

    public function testInitialize() {
        $this->assertInstanceOf(
            java\io\File::class,
            new java\io\File(uniqid().".txt")
        );
    }

    public function testCreateNewFile() {
        $filename = uniqid().".txt";
        $file = new java\io\File($filename);
        $file->createNewFile();
        fwrite($file->getHandle(), "phpunit");
        $file->close();
        $this->assertEquals(
            file_exists($filename),
            true
        );
        @unlink($filename);
    }

}

