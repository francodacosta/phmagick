<?php
namespace phMagick\Core;
use phMagick\Core\Path;

class Settings
{
    static private $instance = null;
    private $binaryPath = null;
    private $debug = false;

    public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Settings();
        }

        return self::$instance;
    }

    public function setImagemagickBinaryPath($path)
    {
        $this->binaryPath = new Path($path);
    }

    public function getImagemagickBinaryPath()
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
