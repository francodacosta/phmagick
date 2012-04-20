<?php
namespace phMagick\Core;

use phMagick\Core\Path;

Class Command
{
    private $source;
    private $destination;
    private $cmd = array();
    private $binaryBase = null;

    public function __construct($source = null, $destination = null)
    {
        $this->setSource($source);
        $this->setDestination($destination);
    }

    /*
     *
    * Getters and setters
    *
    */

    public function setBinaryBase(Path $path)
    {
        $this->binaryBase = $path;
    }

    public function getBinaryBase()
    {
        if (is_null($this->binaryBase)) {
            $this->binaryBase = new Path();
        }

        return $this->binaryBase;
    }

    public function setSource($source)
    {
        $this->source = $this->toPathObject($source);
    }

    public function getSource ()
    {
        return $this->source;
    }

    public function setDestination($path)
    {
        $this->destination = $this->toPathObject($path);
    }

    public function getDestination()
    {
        return $this->destination;
    }

    /*
     *
    *  Logic
    *
    */

    /**
     *
     * Set's an imagemagick value
     *
     * @param string $parameter the parameter name
     * @param string $value the parameter value
     * param boolean $quotes the parameter value, if present will be surrounded by quotes
     */
    function set($parameter, $value = '', $quotes = TRUE)
    {

        if ( strlen($value) > 0 )
        {
            if ( TRUE == $quotes )
            {
                $value = '"' . $value . '"';
            }

            $value =  $value;
        }

        $this->_appendToCmd($parameter , $value);
        return $this;
    }

    /**
     * adds a file name to the command list
     *
     * @param string $file, the filename
     */
    function file($file)
    {
        return $this->set('', $file, TRUE);
    }

    function binary ($name)
    {
        $binary = $this->getBinaryBase();
        $binary->add($name);

        return $this->option($name);
    }
    /**
     * Sets an Parameter
     *
     * @param string $parameter the parameter name
     * @param string $value the parameter value
     * @param boolean $quotes the parameter value, if present will be surrounded by quotes
     */
    function param($parameter, $value = '', $quotes = TRUE)
    {
        return $this->set($parameter, $value, $quotes);
    }

    /**
     * Set's an option (a parameter without a value) Alias for setParameter($option, '', false)
     *
     * @param string $option the parameter name
     */
    function option($option)
    {
        return $this->set($option, '', FALSE);
    }

    /**
    * returns the shell command, ready to be used in the command line
    */
    function toString()
    {
        return trim(implode(' ', $this->_cmd));
    }

    public function __toString()
    {
        return $this->toString();
    }

    /*
     *
    *  Private methods
    *
    */
    protected function toPathObject($path)
    {
//         if (is_null($path)) {
//             return new Path();
//         }
        if ($path instanceof \phMagick\Core\Path) {
            return $path;
        }

        return new Path($path);
    }


    protected function _appendToCmd($cmd)
    {
        $args = func_get_args();
        foreach ( $args as $cmd)
        {
//             if( is_a($cmd, 'phMagick\Core\Command') )
//             {
//                 $this->_cmd[] = $cmd-();
//             }
//             elseif (is_string ($cmd) && (strlen($cmd) > 0 ) )
//             {
                $this->_cmd[]= $cmd;
//             }
        }
    }
}