<?php
namespace phMagick\Core;

class AutoLoad
{

    private $classPath = array();

    public function setClassPath($namespace, $path)
    {
        $this->classPath[$namespace] = $path;
    }

    public function getClassPath()
    {
        return $this->classPath;
    }

    public function __construct()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function loadClass($className)
    {

        $paths = $this->getClassPath();
        foreach($paths as $ns => $path) {
            $className = str_replace($ns, $path, $className);
        }

        include str_replace('\\', '/', $className) . '.php';
    }
}