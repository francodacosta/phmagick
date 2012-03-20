<?php
namespace fTest;

/**
 * Manages test execution
 * @author nuno costa <nuno@francodacosta.com>
 *
 */
class TestRunner
{
    private $tests = array();
    private $results = array();

    /**
     * adds a test to be executed
     * @param TestCase $test
     */
    public function add(TestCase $test)
    {
        $this->tests[] = $test;
    }

    /**
     * run all tests added to the runner
     */
    public function run()
    {
        foreach ($this->tests as $test) {
            $test->execute();
        }
    }
}