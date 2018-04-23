<?php
namespace java\io;


class FileWriter extends Writer {
	protected $file;

	public function __construct(File $file) {
		$this->file = $file;
	}

	public function write() {

	}

	public function flush() {

	}

	public function close() {
		
	}
}