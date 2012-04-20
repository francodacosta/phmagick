<?php
namespace phMagick\Core;

// not needed, just added here for clarity
use phMagick\Core\Command;

/**
 *
 * Base class for phMagick Action
 * @author nuno
 * @package phmagick
 * @subpackage core
 *
 */
Abstract class Action
{
    private $source;
    private $destination;
    /**
     *
     * holds valid values for imagemagick gravity
     * @var array[string]
     */
    protected $gravityValues = array(
        'northwest',
        'north',
        'northeast',
        'west',
        'center',
        'east',
        'southwest',
        'south',
        'southeast'
    );

    /**
     *
     * checks if gravity is an allowed value
     * @param String  $gravity
     * @return Boolean
     */
    public function isValidGravity($gravity)
    {
        return in_array(strtolower($gravity), $this->gravityValues);
    }
    /**
     *
     * to be overwritten from Action classes
     *
     * this method should return the phMagick shell command to be executed
     *
     * @return Command
     */
    abstract function getShellCommand();

    /**
     *
     * created the class and set the source and destination file paths
     * @param String $source
     * @param String $destination
     */
    public function __construct($source, $destination)
    {
        $this->setSource($source);
        $this->setDestination($destination);
    }

    /**
     *
     * Sets the file path of the file to be transformed
     * @param String $file
     */
    public function setSource($file)
    {
        $this->source = $file;
        return $this;
    }
    /**
    *
    * Gets the file path of the file to be transformed
    * return String
    */
    public function getSource()
    {
        return $this->source;
    }

    /**
    *
    * Sets the file path of the file transformed file (new file)
    * @param String $file
    */
    public function setDestination($file)
    {
        $this->destination = $file;
        return $this;
    }

    /**
    *
    * Gets the file path of the file transformed file (new file)
    * return String
    */
    public function getDestination()
    {
        return $this->destination;
    }

}