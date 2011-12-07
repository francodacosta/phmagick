<?php
class PhMagickFile
{
    private $_path = NULL;

    function set($path)
    {
        $this->_path = $path;
        return $this;
    }

    function get()
    {
        return $this->_path;
    }

    function format()
    {

        $path = $this->get();

        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);


        if( is_dir($path)){
            $dirname = $path;
            $file    = '';
        }else{
            $dirname = dirname($path);
            $file    = basename($path);
        }


        if ( strrpos($dirname, DIRECTORY_SEPARATOR) < strlen($dirname))
        {
            $dirname .= DIRECTORY_SEPARATOR;
        }


        $path = $dirname . $file ;

        $path = str_replace(' ','\ ',$path) ;

        $this->set($path);
        return $this;
    }

    function up()
    {
        $this->set( dirname($this->get()) );
        return $this;
    }

    function add($item)
    {
        $this->set (
            $this->get() . DIRECTORY_SEPARATOR . $item
        );
        return $this;
    }
}