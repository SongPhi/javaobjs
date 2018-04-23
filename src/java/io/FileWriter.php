<?php
namespace java\io;

class FileWriter extends Writer {
	protected $file;

	public function __construct(java\io\File $file) {
		$this->file = $file->getHandle();
	}

	public function write($string) {
		fputs($this->file, $string);
	}

	public function flush() {
		fflush($this->file);
	}

	public function close() {
		fclose($this->file);
	}
}