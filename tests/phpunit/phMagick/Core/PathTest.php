<?php
use  phMagick\Core\Path;

class pathTest extends \PHPUnit_Framework_TestCase
{
	private $obj;

	function  setUp()
	{
	 chdir(__DIR__.'/../../');
	}

	function testFormatPath()
	{
	    $o = $this->obj;

	    $path = new Path('fixtures');
	    $this->assertEquals('fixtures/', $path->format());

	    $path = new Path('fixtures/file/folder1');
	    $this->assertEquals('fixtures/file/folder1/', $path->format());

	    $path = new Path('fixtures/file\folder1');
	    $this->assertEquals('fixtures/file/folder1/', $path->format());

	    $path = new Path('fixtures/file/folder 2');
	    $this->assertEquals('fixtures/file/folder\ 2/', $path->format());

	    $path = new Path('fixtures/file/folder1/file 2.txt');
	    $this->assertEquals('fixtures/file/folder1/file\ 2.txt', $path->format());

	    $path = new Path('fixtures/file/folder1/file1.txt');
	    $this->assertEquals('fixtures/file/folder1/file1.txt', $path->format());

// 	    $path = new Path('file');
// 	    $this->assertEquals('./file', $path->format());

// 	    $path = new Path('file.txt');
// 	    $this->assertEquals('./file.txt', $path->format());

	}
}