<?php
/**
 *
 * Commom function for PhMagick
 * @author nuno
 *
 */
class PhMagickCore {
    protected $_binaryBasePath = NULL;
    protected $_sourceFile     = NULL;
    protected $_destFile       = NULL;
    protected $_fileHandler    = NULL;

    function __construct(PhMagickFile $fileHandler)
    {
        $this->_fileHandler = $fileHandler;
    }

    function getBinaryBasePath()
    {
        return $this->_binaryBasePath;
    }

    function setBinaryBasePath($path)
    {
        $this->_binaryBasePath = $this->_fileHandler->set($path)->format()->get();
        return $this;
    }

    function setSourceFile($path)
    {
        $this->_sourceFile = $this->_fileHandler->set($path)->format()->get();
        return $this;
    }

    function getSourceFile()
    {
        return $this->_sourceFile;
    }

    function setDestinationFile($path)
    {
        $this->_destFile = $this->_fileHandler->set($path)->format()->get();
        return $this;
    }

    function getDestinationFile()
    {
        return $this->_destFile;
    }

    function isWindows()
    {
        return ( !(strstr(PHP_OS,'WIN') === FALSE) );
    }

}