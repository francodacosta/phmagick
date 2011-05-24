<?php

class coreTest extends PHPUnit_Framework_TestCase
{
	private $obj;

	function  setUp()
	{
	    $file = new PhMagickFile();
		$this->obj = new phMagickCore($file);
	}

	function testGettersAndSetters()
	{
	    $o = $this->obj;

	    $o->setBinaryBasePath('fixtures');
	    $this->assertEquals('fixtures/', $o->getBinaryBasePath());

	    $o->setDestinationFile('fixtures');
	    $this->assertEquals('fixtures/', $o->getDestinationFile());

	    $o->setSourceFile('fixtures');
	    $this->assertEquals('fixtures/', $o->getSourceFile());
	}

	function testIsWindows()
	{
	    $this->assertFalse($this->obj->isWindows());
	}
}