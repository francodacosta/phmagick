<?php
namespace phMagick\Command;

use phMagick\Core\Action;

class Resize extends Action
{

    private $width = null;
    private $height = 0;

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
   /**
    *
    * Proportional resize of images.
    * if height = 0 the resize is based on the new width
    * if width  = 0 the resize is based on the new height
    * if width and height > 0 image magick will try to match both measurements
    * while keeping the aspect ratio so the final image might not have the
    * exact dimentions requested but the closest dimentions possible
    *
    * @param Integer $width, the new width
    * @param Integet $height, the new height, defaults to 0
    */
    public function execute ()
    {
        $command = $this->getCommand();
        $system  = $this->getSystem();

        $width = $this->getWidth();
        $height = $this->getHeight();
        $width   = $width  == 0 ? '' : $width;
        $height  = $height == 0 ? '' : $height;

        if ($width < 0) {
            throw new \InvalidArgumentException('With must not be negative');
        }

        if ($height < 0) {
            throw new \InvalidArgumentException('Height must not be negative');
        }

        if ( ($width == 0) && ($height == 0)) {
            throw new \InvalidArgumentException('Either width or height must be greater than 0');
        }

        $command->binary('convert')
                ->file($this->getSource())
                ->param('-scale', $width . 'x' . $height)
                ->file($this->getDestination())
        ;

        return $command;
    }
}