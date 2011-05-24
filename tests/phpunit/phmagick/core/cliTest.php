<?php
class cliTest extends PHPUnit_Framework_TestCase
{
	private $obj;

	function  setUp()
	{
		$this->obj = new phMagickCli(new PhMagickLogger());
	}

	function testGettersAndSetters()
	{
	}

}