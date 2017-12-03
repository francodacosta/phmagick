<?php
namespace phMagick\Action;

use phMagick\Core\Action;
use phMagick\Core\Command;

/**
 *
 * Crops an image
 *
 * This is a simplifyed version of crop. it crops an image based on a gravity
 * by default it starts cropping from the center of the image
 *
 * top and left are relative to the gravity
 *
 * @author nuno
 * @package action
 */
class SimpleCrop extends Action
{
    private $gravity = 'center';
    private $width = null;
    private $height = null;
    private $top = 0;
    private $left = 0;

    /**
     * Gets the watermark image positioning
     * @see http://www.imagemagick.org/script/command-line-options.php#gravity
     * @return string
     */
    public function getGravity()
    {
        return $this->gravity;
    }

    /**
     * Sets the watermark image positioning
     * @see http://www.imagemagick.org/script/command-line-options.php#gravity
     * @param String $gravity
     */
    public function setGravity($gravity)
    {
        if (!$this->isValidGravity($gravity)) {
            throw new \InvalidArgumentException('Crop: gravity value is not valid');
        }
        $this->gravity = $gravity;

        return $this;
    }

    /**
     * @return int
     */

    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $width = (int)$width;

        if ($width <= 0) {
            throw new \InvalidArgumentException('Crop: width must greater than 0');
        }
        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $height = (int)$height;

        if ($height <= 0) {
            throw new \InvalidArgumentException('Crop: height must greater than 0');
        }

        $this->height = $height;

        return $this;
    }

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param int $top
     */
    public function setTop($top)
    {
        $this->top = (int)$top;

        return $this;
    }

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param int $left
     */
    public function setLeft($left)
    {
        $this->left = (int)$left;

        return $this;
    }

    public function getShellCommand()
    {
        $command = new Command();

        $width = $this->getWidth();
        if (is_null($width)) {
            throw new \InvalidArgumentException('Crop: please specify width');
        }

        $height = $this->getHeight();
        if (is_null($height)) {
            throw new \InvalidArgumentException('Crop: please specify height');
        }

        $top = $this->getTop();
        $left = $this->getLeft();
        $gravity = $this->getGravity();
        $command
            ->binary('convert')
            ->file($this->getSource())
            ->param('-gravity', $gravity, true)
            ->param('-crop', $width . 'x' . $height . '+' . $left . '+' . $top)
            ->file($this->getDestination());

        return $command;
    }
}