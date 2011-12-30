<?php
namespace phMagick\Action\Resize;
use phMagick\Core\Action;

/**
 *
 * Base class for resize actions
 * @package action
 * @subpackage resize
 */
Abstract class Base extends Action
{

    /**
     * holds width
     * @var Integer
     */
    protected $width = 0;

    /**
     * holds height
    * @var Integer
    */
    protected $height = 0;

    /**
     * Contructs the resize class and sets base parameters
     *
     * @param String $source the filename of the source file
     * @param String $destination the name of the new file
     * @param Integer $width desired width
     * @param Integer $height desired height
     * @inheritDoc
     */
    public function __construct($source, $destination, $width = 0, $height = 0)
    {
        $this->setWidth($width);
        $this->setHeight($height);
        parent::__construct($source, $destination);
    }

    /**
     *
     * Sets the width of the resized image
     * @param Integer $width
     *  @inheritDoc
     */
    public function setWidth($width)
    {
        $this->width = floatval($width);
        return $this;
    }

    /**
     * Gets the width of the resized image
     * @return Integer
     */
    public function getWidth()

    {
        return $this->width;
    }

    /**
     *
     * Sets the height of the resized image
     * @param Integer $height
     */
    public function setHeight($height)
    {
        $this->height = floatval($height);
        return $this;
    }

    /**
     *
     * Gets the height of the resized image
     * @return Integer
     */
    public function getHeight()
    {
        return $this->height;
    }

}
