<?php

class pmTest extends PHPUnit_Framework_TestCase
{
    private $obj;

	function  setUp()
	{
	    $fileHandler = new PhMagickFile();
		$this->obj = new phMagickPluginManager('./fixtures/plugins', $fileHandler);
	}

	function testGettersAndSetters()
	{
	    $o = $this->obj;

	    $o->setPluginsFolder('fixtures');
	    $this->assertEquals('fixtures/', $o->getPluginsFolder());

	    $f = new PhMagickFile();
	    $o->setFileHandler($f);
	    $this->assertSame($f, $o->getFileHandler());

	    $this->assertEquals(array(), $o->getLoadedPlugins());
	    $this->assertEquals(array(), $o->getMethods());
	}

	/**
	 * @depends testGettersAndSetters
	 */
	function testConstructor()
	{
	    $fileHandler = new PhMagickFile();
		$o= new phMagickPluginManager('./fixtures/plugins', $fileHandler);

	    $this->assertSame($fileHandler, $o->getFileHandler());

	    $this->assertEquals('./fixtures/plugins', $o->getPluginsFolder());
	}

	/**
	 * @depends testConstructor
	 */
	function testAddMethod()
	{
	    $o = $this->obj;
	    $method = 'method';
	    $pluginClsName = 'class';
	    $o->addMethod($method, $pluginClsName);

	    $methods = $o->getMethods();
	    $this->assertEquals($pluginClsName, $methods[$method]);
	}

	/**
	 * @depends testAddMethod
	 */
	function testLoadPlugin()
	{
	    $o = $this->obj;
	    $o->loadPlugin('./fixtures/plugins/plugin1.php');

	    $methods = $o->getMethods();
	    $this->assertTrue(key_exists('method1', $methods));
	}

	/**
	 * @depends testLoadPlugin
	 */
	function testLoadAll()
	{
	    $o = $this->obj;
	    $o->loadPlugin('./fixtures/plugins/plugin1.php');
	    $o->loadAll();

	    $methods = $o->getMethods();
	    $this->assertArrayHasKey('method1', $methods);

	    $methods = $o->getMethods();
	    $this->assertArrayHasKey('method2', $methods);

	    $plugins = $o->getLoadedPlugins();
	    $this->assertArrayHasKey('plugin1', $plugins);
	    $this->assertArrayHasKey('plugin2', $plugins);
	}

	/**
	 * @depends testLoadAll
	 */
	function testMethodExists()
	{
	    $o = $this->obj;
	    $o->loadAll();

	    $this->assertTrue($o->methodExists('method1'));
	    $this->assertFalse($o->methodExists('no'));
	}

	/**
	 * @depends testLoadAll
	 */
	function testPluginExists()
	{
	    $o = $this->obj;
	    $o->loadAll();

	    $this->assertTrue($o->pluginExists('plugin1'));
	    $this->assertFalse($o->pluginExists('no'));
	}

}