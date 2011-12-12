<?php

namespace phMagick\Core;

class loggerTest extends \
PHPUnit_Framework_TestCase
{
	private $obj;

	function  setUp()
	{
		$this->obj = new Logger();
	}

	function testAppendAndGet()
	{
	    $o = $this->obj;
	    $o->append('log item');

	    $items = $o->get();
	    $this->assertEquals('log item', $items[0]);
	}

	function testGetAt()
	{
	    $o = $this->obj;

	    $o->append(0);
	    $o->append(1);
	    $o->append(2);

	    $this->assertEquals(0, $o->getAt(0));
	    $this->assertEquals(1, $o->getAt(1));
	    $this->assertEquals(2, $o->getAt(2));

	    $this->assertNull($o->getAt(11));
	}

	function testClear()
	{
	    $o = $this->obj;

	    $o->append(0);
	    $o->append(1);
	    $o->append(2);

	    $o->clear();

	    $this->assertSame(array(), $o->get());
	}

	function test__ToString()
	{
	    $o = $this->obj;

	    $o->append(0);
	    $o->append(1);
	    $o->append(2);

	    $str = ''. $o ;
	    $this->assertEquals("0\n1\n2\n", $str);
	}

// 	function test__ToString_withArray()
// 	{
// 	    $o = $this->obj;

// 	    $o->append(0);
// 	    $o->append(1);
// 	    $o->append(array(0,1));

// 	    $str = ''. $o ;
// 	    echo "#$str#";
// 	    $this->assertEquals("0\n1\n2\n", $str);
// 	}

}