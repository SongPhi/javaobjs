<?php
namespace java\io;

class File {
    protected $filename;
    protected $handle = null;
    protected $opened = false;

    function __construct($filename) {
        $this->filename = $filename;
    }

    public function exists() {
        return file_exists($this->filename);
    }

    public function createNewFile() {
        $this->handle = fopen($this->filename, "w+");
        $this->opened = true;
    }

    public function &getHandle() {
        return $this->handle;
    }

    public function close() {
        if ($this->handle != null && $this->opened) {
            fclose($this->handle);
            $this->opened = false;
        }
    }

    function __destruct() {
        $this->close();
    }
}