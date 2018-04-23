<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FileWriterTest extends TestCase
{

    public function testWrite() {
        $filename = uniqid().".txt";
        $file = new \java\io\File($filename);
        $file->createNewFile();
        $writer = new \java\io\FileWriter($file);
        $writer->write("hello world");
        $writer->close();
        $this->assertEquals(
            file_get_contents($filename),
            "hello world"
        );
        @unlink($filename);
    }
}

