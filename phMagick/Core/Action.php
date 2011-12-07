<?php
namespace phMagick\Core;

// not needed, just added here for clarity
use phMagick\Core\Command;

Abstract class Action
{
    private $source;
    private $destination;
    private $command;

    public function __construct($source, $destination)
    {
        $this->setSource($source);
        $this->setDestination($destination);
    }

    public function setSource($file)
    {
        $this->source = $file;
        return $this;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setDestination($file)
    {
        $this->destination = $file;
        return $this;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function getCommand()
    {
        $command = $this->getVar('command');
        return $command;
    }

    private function getVar($name) {
        if (is_null($this->$var)) {
            $class = ucfirst($var);
            $this->$var = &new $class();
        }

        return $this->$var;
    }

    abstract function execute()
    {
    }
}