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
     * @return String
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
            throw new \InvalidArgumentException('gravity value is not valid');
        }
        $this->gravity = $gravity;
    }

    /**
     * @return the Integer
     */

    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param Integer $width
     */

    public function setWidth($width)
    {
        if (! is_int($width)) {
            throw new \InvalidArgumentException('width must be an integer');
        }

        if (! $width > 0) {
            throw new \InvalidArgumentException('width must greater than 0');
        }
        $this->width = $width;
    }

    /**
     * @return the Integer
     */

    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param Integer $height
     */

    public function setHeight($height)
    {
        if (! is_int($height)) {
            throw new \InvalidArgumentException('height must be an integer');
        }

        if (! $height > 0) {
            throw new \InvalidArgumentException('height must greater than 0');
        }

        $this->height = $height;
    }

    /**
     * @return the Integer
     */

    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param Integer $top
     */

    public function setTop($top)
    {
        if (! is_int($top)) {
            throw new \InvalidArgumentException('top must be an integer');
        }

        $this->top = $top;
    }

    /**
     * @return the Integer
     */

    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param Integer $left
     */

    public function setLeft($left)
    {
        if (! is_int($left)) {
            throw new \InvalidArgumentException('left must be an integer');
        }
        $this->left = $left;
    }

    public function getShellCommand()
    {
        $command = new Command();

        $width = $this->getWidth();
        if (is_null($width)) {
            throw new \InvalidArgumentException('please specify width');
        }

        $height = $this->getHeight();
        if (is_null($height)) {
            throw new \InvalidArgumentException('please specify height');
        }

        $top = $this->getTop();
        $left = $this->getLeft();
        $gravity = $this->getGravity();
        $command->binary('convert')
                ->file($this->getSource())
                ->param('-gravity', $gravity, true)
                ->param('-crop', $width . 'x' . $height . '+' . $left . '+' . $top)
                ->file($this->getDestination());


        return $command;
    }

}
