<?php
namespace phMagick\Core;

use phMagick\Core\Exception\PathNotFoundException;
class Path
{
    private $path;
    public function __construct($path = null)
    {
        $this->setPath($path);
    }

    private function setPath($path)
    {
        $this->path = $path;
    }

    private function getPath()
    {
        return $this->path;
    }

    function format()
    {

        $path = $this->getPath();

        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);


        if ( is_dir($path)) {
            $dirname = $path;
            $file    = '';
        } elseif (is_file($path)) {
            $dirname = dirname($path);
            $file    = basename($path);
        } else {
            throw new PathNotFoundException($path . ' not found');
        }


        $dirname = rtrim($dirname, DIRECTORY_SEPARATOR);
        $dirname .= DIRECTORY_SEPARATOR;


        $path = $dirname . $file ;

        $path = str_replace(' ','\ ',$path) ;
        $this->setPath($path);
        return $path;
    }

    public function __toString()
    {
        try {
            $ret = $this->format();
        } Catch (\Exception $e) {
            $ret = '';
        }

        return $ret;
    }

    function up()
    {
        $this->setPath( dirname($this->getPath()) );
        return $this;
    }

    function add($item)
    {
        $this->setPath (
            $this->getPath() . DIRECTORY_SEPARATOR . $item
        );
        return $this;
    }
}