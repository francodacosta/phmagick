<?php
namespace fTest;

class Result
{
    private $result = false;
    private $message = 'not executed';

    public function __construct($code = false, $message = "error found")
    {
        $this->setMessage($message);
        $this->setResult($code);
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

}
