<?php
namespace phMagick\Action;
use phMagick\Core\Action;
use phMagick\Core\Command;
/**
 *
 * Watermarks an image
 *
 * this Action allows to overlay an image on top of another
 *
 * @author nuno
 * @package action
 */
class Watermark extends Action
{
    private $watermarkImage = null;
    private $gravity = 'center';
    private $transparency = 50;

    /**
     *
     * Gets the path to the watermark image
     * @return String
     */

    public function getWatermarkImage()
    {
        return $this->watermark;
    }

    /**
     *
     * Sets the path to the watermark image
     * @param String $watermark
     */

    public function setWatermarkImage($watermark)
    {
        $this->watermark = $watermark;
    }

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
        if (! $this->isValidGravity($gravity)) {
            throw new \InvalidArgumentException('gravity value is not valid');
        }
        $this->gravity = $gravity;
    }

    /**
     * gets the watermark image transparency
     * @return Integer
     */

    public function getTransparency()
    {
        return $this->transparency;
    }

    /**
     * Sets the watermark image transparency
     * @param Integer $transparency an integer from 0 to 100
     */

    public function setTransparency($transparency)
    {
        if (! is_int($transparency)) {
            throw new \InvalidArgumentException('transparency must be an Integer');
        }
        if ($transparency < 0 || $transparency > 100) {
            throw new \InvalidArgumentException('transparency must be between 0 and 100');
        }
        $this->transparency = $transparency;
    }

    public function getShellCommand()
    {
        $command = new Command();
        $transparency = $this->getTransparency();
        $watermark = $this->getWatermarkImage();
        $gravity = $this->getGravity();

        $command->binary('composite')
                ->param('-dissolve', $transparency)
                ->param('-gravity', $gravity, true)
                ->file($watermark)
                ->file($this->getSource())
                ->file($this->getDestination());

        return $command;
    }

}
