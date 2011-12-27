<?php
namespace fTest;

abstract class TestCase
{
    private $result = null;
    private $title = '';

    public function __construct(Result $result = null)
    {
        if (!is_null($result)) {
            $this->setResult($result);
        }
    }

    abstract public function test();

    public function checkResults()
    {
        return true;
    }

    public function renderResults()
    {

    }

    public function getTestCode()
    {
        $reflector = new \ReflectionClass($this);
        $method = $reflector->getMethod('test');

        if( !file_exists( $method->getFileName() ) ) return false;

//         $start_offset = ( $method->getStartLine() - 1 );
//         $end_offset   = ( $method->getEndLine() - $method->getStartLine() ) + 1;

        $start_offset = ( $method->getStartLine()  + 1);
        $end_offset   = ( $method->getEndLine() - $method->getStartLine() -2 ) ;

        return join( '', array_slice( file( $method->getFileName() ), $start_offset, $end_offset ) );
    }

    public function execute()
    {
        try {
            $this->test();
            if ($this->checkResults() === false) {
                throw new \Exception('checkResults returned false', 300);
            }
            $result = new Result(0, 'no errors');
            $this->setResult($result);
            $this->renderResults();

        } catch (\Exception $e) {
            $result = new Result($e->getCode(), $e->getMEssage());
            $this->setResult($result);
        }
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult(Result $result)
    {
        $this->result = $result;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

}
