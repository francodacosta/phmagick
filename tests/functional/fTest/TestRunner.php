<?php
namespace fTest;

class TestRunner
{
    private $tests = array();
    private $results = array();

    public function add(TestCase $test)
    {
        $this->tests[] = $test;
    }

    public function run()
    {
        foreach ($this->tests as $test) {
            $test->execute();
        }
    }
}