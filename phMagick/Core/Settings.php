<?php
namespace phMagck\Core;
use phMagick\Core\Path;

final class Settings
{
    static private $instance = null;
    private $binaryPath = null;
    private $debug = false;

    public function getInstance()
    {
        if (is_null(self::$instance)){
            self::$instance = new Settings();
        }
    }

    public function setImagemagickBinaryPath($path)
    {
        $this->binaryPath = new Path($path);
    }

    public function setImagemagickBinaryPath()
    {
        if (is_null($this->binaryPath)) {
            $this->binaryPath = new Path();
        }

        return $this->binaryPath;
    }

    public function setDebug($boolean)
    {
        $this->debug = $boolean;
    }

    public function isDebug()
    {
        return $this->debug;
    }
}