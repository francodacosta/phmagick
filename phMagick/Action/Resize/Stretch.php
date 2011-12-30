<?php
namespace phMagick\Action\Resize;
use phMagick\Core\Command;
/**
 *
 * Fixed resize of images.
 *
 * The image will be streched to the exact dimentions provided aspect ratio
 * will not be preserved
 *
 * @package action
 * @subpackage resize
 */
class Stretch extends Base
{

    /**
     * gets the shell command to be executed
     * @see phMagick\Core.Action::getShellCommand()
     */
    public function getShellCommand()
    {
        $command = new Command();

        $width = $this->getWidth();
        $height = $this->getHeight();

        if ($width < 0) {
            throw new \InvalidArgumentException('With must not be negative');
        }

        if ($height < 0) {
            throw new \InvalidArgumentException('Height must not be negative');
        }

        if (($width == 0) && ($height == 0)) {
            throw new \InvalidArgumentException('width and height must be greater than 0');
        }

        $command->binary('convert')
                ->file($this->getSource())
                ->param('-scale', $width . 'x' . $height . '!')
                ->file($this->getDestination());

        return $command;
    }
}
