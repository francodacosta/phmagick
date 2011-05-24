<?php

class fileTest extends PHPUnit_Framework_TestCase
{
	private $obj;

	function  setUp()
	{
		$this->obj = new phMagickFile();
	}

	function testFormatPath()
	{
	    $o = $this->obj;

	    $path = $o->set('fixtures')->format()->get();
	    $this->assertEquals('fixtures/', $path);

	    $path = $o->set('fixtures/file/folder1')->format()->get();
	    $this->assertEquals('fixtures/file/folder1/', $path);

	    $path = $o->set('fixtures/file\folder1')->format()->get();
	    $this->assertEquals('fixtures/file/folder1/', $path);

	    $path = $o->set('fixtures/file/folder 2')->format()->get();
	    $this->assertEquals('fixtures/file/folder\ 2/', $path);

	    $path = $o->set('fixtures/file/folder 2/file 2.txt')->format()->get();
	    $this->assertEquals('fixtures/file/folder\ 2/file\ 2.txt', $path);

	    $path = $o->set('fixtures/file/folder1/file1.txt')->format()->get();
	    $this->assertEquals('fixtures/file/folder1/file1.txt', $path);

	    $path = $o->set('file')->format()->get();
	    $this->assertEquals('./file', $path);

	    $path = $o->set('file.txt')->format()->get();
	    $this->assertEquals('./file.txt', $path);

	}
}