<?php
namespace java\io;

class File {
    protected $filename;
    protected $handle = null;

    function __construct($filename) {
        $this->filename = $filename;
    }

    public function exists() {
        return file_exists($this->filename);
    }

    public function createNewFile() {
        $this->handle = fopen($this->filename, "w");
    }

    function __destruct() {
        if (!$this->handle)
            fclose($this->handle);
    }
}