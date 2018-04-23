<?php
namespace java\io;

class FileWriter extends Writer {
	protected $file;

	public function __construct(\java\io\File $file) {
		$this->file = $file;
	}

	public function write($string) {
		fputs($this->file->getHandle(), $string);
	}

	public function flush() {
		fflush($this->file->getHandle());
	}

	public function close() {
		$this->file->close();
	}
}
