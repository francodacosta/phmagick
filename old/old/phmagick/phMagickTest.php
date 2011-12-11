<?php
class PhMagickTest extends PHPUnit_Framework_TestCase
{
    private $obj;

	function  setUp()
	{
		$this->obj = new phMagick();
	}

	function testGetAndSetSource()
	{
	    $o = $this->obj;

	    $o->setSourceFile('fixtures');
	    $this->assertEquals('fixtures/', $o->getSourceFile());

	    $o->source('fixtures\file');
	    $this->assertEquals('fixtures/file/', $o->source());
	}

	function testGetAndSetDEstination()
	{
	    $o = $this->obj;

	    $o->setDestinationFile('fixtures');
	    $this->assertEquals('fixtures/', $o->getDestinationFile());

	    $o->destination('fixtures/file');
	    $this->assertEquals('fixtures/file/', $o->destination());

	}

	function testGetAndSetBinary()
	{
	    $o = $this->obj;

	    $o->setBinaryBasePath('fixtures');
	    $this->assertEquals('fixtures/', $o->getBinaryBasePath());

	    $o->binary('fixtures/file');
	    $this->assertEquals('fixtures/file/', $o->binary());

	}

	function testGetAndSetPluginManager()
	{
	    $o = $this->obj;

	    $f = new PhMagickFile();
	    $p = new PhMagickPluginManager('.', $f);

	    $o->setPluginManager($p);
	    $this->assertSame($p, $o->getPluginManager());

	}

	function testGettersAndSetters()
	{
	    $o = $this->obj;

	    $o->debug();
	    $this->assertTrue($o->debugMode());

	    $o->debug(TRUE);
	    $this->assertTrue($o->debugMode());

	    $o->debug(FALSE);
	    $this->assertFalse($o->debugMode());

	    $l = new PhMagickLogger();
	    $o->setLogger($l);
	    $this->assertSame($l, $o->getLogger());

	}
}