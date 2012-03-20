<?php
namespace fTest;

/**
 * Base test case
 * @author nuno costa <nuno@francodacosta.com>
 *
 */
abstract class TestCase
{
    private $result = null;
    private $title = '';

    /**
     * The test code, this code will be used in the generated documentation
     */
    abstract public function test();

    /**
     * returns true if the test passed
     *
     * should be overriden in your test class
     * @return boolean
     */
    public function checkResults()
    {
        return true;
    }

    /**
     * Used to render the results
     *
     * usefull for generating the documentation
     */
    public function renderResults()
    {

    }

    /**
     * gets the code for this test
     * @return String
     */
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

    /**
     * executes the test
     * @throws \Exception
     */
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

    /**
     * gets the test result object
     */
    public function getResult()
    {
        return $this->result;
    }

    protected function setResult(Result $result)
    {
        $this->result = $result;
    }

    /**
     * gets the test title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * sets the test title
     * @param String $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}
