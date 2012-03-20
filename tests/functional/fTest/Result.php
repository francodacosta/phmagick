<?php
namespace fTest;

/**
 * Represents a test result
 * @author nuno costa <nuno@francodacosta.com>
 *
 */
class Result
{
    private $result = false;
    private $message = 'not executed';

    /**
     * Creates the result class, by default the result is a failure
     * @param Boolean|Integer $result
     * @param String $message
     */
    public function __construct($result = false, $message = "error found")
    {
        $this->setMessage($message);
        $this->setResult($result);
    }

    /**
     * return the result
     * @return Boolean|Integer
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Sets the result
     * @param Boolean|Integer $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * gets the error message/reason
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * sets the error message
     * @param String $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}
