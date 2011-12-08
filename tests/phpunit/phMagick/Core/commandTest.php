<?php

use phMagick\Core\Command;
class CommandTEst extends PHPUnit_Framework_TestCase
{
	private $obj;

	function  setUp()
	{
		$this->obj = new Command();
	}

	function testSetWithQuotes()
	{
		$o = $this->obj;

		$o->set('param', 'value', true);
		$this->assertEquals('param "value"',$o->getShellCommand());
	}

	function testSetWithoutQuotes()
	{
		$o = $this->obj;

		$o->set('param', 'value', false);
		$this->assertEquals('param value',$o->getShellCommand());
	}

	/**
     * @depends testSetWithQuotes
     */
	function testParameterWithQuotes()
	{
		$o = $this->obj;

		$o->param('param', 'value', true);
		$this->assertEquals('param "value"',$o->getShellCommand());
	}

	/**
     * @depends testSetWithoutQuotes
     */
	function testParameterWithoutQuotes()
	{
		$o = $this->obj;

		$o->param('param', 'value', false);
		$this->assertEquals('param value',$o->getShellCommand());
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

		$this->assertEquals('param value param "value"',$o->getShellCommand());
	}

	function testOption()
	{
		$o = $this->obj;

		$o->option('option');
		$this->assertEquals('option',$o->getShellCommand());
	}

	function testFile()
	{
		$o = $this->obj;

		$o->file('file');
		$this->assertEquals('"file"',$o->getShellCommand());
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

		$this->assertEquals('p "v" o',$o->getShellCommand());
	}
	/**
     * @depends testOptionsAndParameters
     */
	function testCmdMerge()
	{
		$o = $this->obj;
		$merge = new Command();
		$merge1 = new Command();
		$o->param('orig', 'orig_value');
		$merge->param('merge', 'merge_value');
		$o->set($merge);

		$this->assertEquals('orig "orig_value" merge "merge_value"',$o->getShellCommand());

                $merge1->param('merge1', 'merge1_value');
		$o->set($merge1);
		$this->assertEquals('orig "orig_value" merge "merge_value" merge1 "merge1_value"',$o->getShellCommand());
	}
}
