<?php

class cmdTest extends PHPUnit_Framework_TestCase
{
	private $obj;

	function  setUp()
	{
		$this->obj = new phMagickCmd();
	}

	function testSetWithQuotes()
	{
		$o = $this->obj;

		$o->set('param', 'value', true);
		$this->assertEquals('param "value"', $o->get());
	}

	function testSetWithoutQuotes()
	{
		$o = $this->obj;

		$o->set('param', 'value', false);
		$this->assertEquals('param value', $o->get());
	}

	/**
     * @depends testSetWithQuotes
     */
	function testParameterWithQuotes()
	{
		$o = $this->obj;

		$o->param('param', 'value', true);
		$this->assertEquals('param "value"', $o->get());
	}

	/**
     * @depends testSetWithoutQuotes
     */
	function testParameterWithoutQuotes()
	{
		$o = $this->obj;

		$o->param('param', 'value', false);
		$this->assertEquals('param value', $o->get());
	}

	/**
     * @depends testSetWithoutQuotes
     * @depends testParameterWithQuotes
     * @depends testParameterWithoutQuotes
     */
	function testAppendSeveralParameters()
	{
		$o = $this->obj;

		$o->param('param', 'value', false);
		$o->param('param', 'value', true);

		$this->assertEquals('param value param "value"', $o->get());
	}

	function testOption()
	{
		$o = $this->obj;

		$o->option('option');
		$this->assertEquals('option', $o->get());
	}

	function testFile()
	{
		$o = $this->obj;

		$o->file('file');
		$this->assertEquals('"file"', $o->get());
	}

	/**
     * @depends testOption
     * @depends testAppendSeveralParameters
     */
	function testOptionsAndParameters()
	{
		$o = $this->obj;

		$o->param('p','v');
		$o->option('o');

		$this->assertEquals('p "v" o', $o->get());
	}
	/**
     * @depends testOptionsAndParameters
     */
	function testCmdMerge()
	{
		$o = $this->obj;
		$merge = new phMagickCmd();
		
		$o->param('orig', 'orig_value');
		$merge->param('merge', 'merge_value');
		$o->set($merge);
		
		$this->assertEquals('orig "orig_value" merge "merge_value"', $o->get());
	}
}
