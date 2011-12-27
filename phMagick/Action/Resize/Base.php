<?php
namespace phMagick\Action\Resize;
use phMagick\Core\Action;

/**
 *
 * Base class for resize actions
 *
 * @param Integer $width, the new width
 * @param Integet $height, the new height, defaults to 0
 */
Abstract class Base extends Action
{

    protected $width = 0;
    protected $height = 0;

    public function __construct($source, $destination, $width = 0, $height = 0)
    {
        $this->setWidth($width);
        $this->setHeight($height);
        parent::__construct($source, $destination);
    }

    public function setWidth($width)
    {
        $this->width = floatval($width);
        return $this;
    }

    public function getWidth()

    {
        return $this->width;
    }

    public function setHeight($height)
    {
        $this->height = floatval($height);
        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

}
