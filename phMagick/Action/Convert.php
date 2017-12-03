<?php
namespace phMagick\Action;

use phMagick\Core\Action;
use phMagick\Core\Command;

/**
 *
 * Convert from one format to the other.
 *
 *
 * @package action
 */
class Convert extends Action
{
    private $optimize = false;
    private $quality = null;
    private $blurRadius = null;
    private $blurSigma = null;

    public function optimize()
    {
        $this->optimize = true;

        return $this;
    }

    public function quality($number)
    {
        $this->quality = $number;

        return $this;
    }

    public function blur($radius, $sigma = 0)
    {
        $this->blurRadius = $radius;
        $this->blurSigma = $sigma;

        return $this;
    }

    /**
     * gets the shell command to be executed
     * @see phMagick\Core.Action::getShellCommand()
     */
    public function getShellCommand()
    {
        $command = new Command();

        $command->binary('convert')
                ->file($this->getSource());

        if ($this->optimize) {
            $command->option('-strip');
        }

        if (null !== $this->quality) {
            $command->param('-quality', $this->quality);
        }

        if ($this->blurRadius !== null || $this->blurSigma !== null) {
            $command->param('-blur', ($this->blurRadius ?: 0) . 'x' . ($this->blurSigma ?: 0));
        }

        $command->file($this->getDestination());

        return $command;
    }
}
