<?php
namespace phMagick\Core;

class SettingsTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->object = new Settings();
    }

    public function testGetInstance()
    {
        $this->assertTrue($this->object->getInstance() instanceof \phMagick\Core\Settings);
    }

    public function testGetSetImagemagickBinaryPath()
    {
        $this->object->getInstance()->setImagemagickBinaryPath('fixtures');

        $path = $this->object->getInstance()->getImagemagickBinaryPath();
        $this->assertTrue($path instanceof \phMagick\Core\Path);

        $this->assertEquals($path->format(), 'fixtures/');
    }

    public function testGetSetDebug()
    {
        $this->object->getInstance()->setDebug(true);
        $this->assertTrue($this->object->getInstance()->isDebug());
    }

}
