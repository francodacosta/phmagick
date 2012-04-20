<?php
namespace phMagick\Core;

class CommandTest extends \PHPUnit_Framework_TestCase
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
		$this->assertEquals('param "value"', $o);
	}

	function testSetWithoutQuotes()
	{
		$o = $this->obj;

		$o->set('param', 'value', false);
		$this->assertEquals('param value', $o);
	}

	/**
     * @depends testSetWithQuotes
     */
	function testParameterWithQuotes()
	{
		$o = $this->obj;

		$o->param('param', 'value', true);
		$this->assertEquals('param "value"', $o);
	}

	/**
     * @depends testSetWithoutQuotes
     */
	function testParameterWithoutQuotes()
	{
		$o = $this->obj;

		$o->param('param', 'value', false);
		$this->assertEquals('param value', $o);
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

		$this->assertEquals('param value param "value"', $o);
	}

	function testOption()
	{
		$o = $this->obj;

		$o->option('option');
		$this->assertEquals('option', $o);
	}

	function testFile()
	{
		$o = $this->obj;

		$o->file('file');
		$this->assertEquals('"file"', $o);
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

		$this->assertEquals('p "v" o', $o);
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

		$this->assertEquals('orig "orig_value" merge "merge_value"', $o);

                $merge1->param('merge1', 'merge1_value');
		$o->set($merge1);
		$this->assertEquals('orig "orig_value" merge "merge_value"  merge1 "merge1_value"', $o->toString());
	}

	public function testSetGetBinaryBase()
	{
        $o = $this->obj;

        $this->assertTrue($o->getBinaryBase() instanceof \phMagick\Core\Path);

        $p = new Path();
        $o->setBinaryBase($p);
        $this->assertSame($p, $o->getBinaryBase());

	}

    public function testGetSource()
	{
	    $path = new Path(realpath(__DIR__ . '/../../fixtures'));
	    $o = new Command($path->format());
	    $this->assertEquals($path->format(), $o->getSource()->format());

	    $o = new Command($path);
	    $this->assertEquals($path, $o->getSource());
	}

	public function testGetDestination()
	{
	    $path = new Path(realpath(__DIR__ . '/../../fixtures'));
	    $o = new Command(null, $path->format());
	    $this->assertEquals($path->format(), $o->getDestination()->format());
	}

	public function testBinary()
	{
	    $o = $this->obj;
	    $this->assertEquals('foo', $o->binary('foo'));
	}
}
