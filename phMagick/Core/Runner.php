<?php
namespace phMagick\Core;
use phMagick\Core\Exception\SystemException;

class Runner extends ActionCollection
{
    private $logger;
    private $debug;

    private $settings = null;


    public function getLogger()
    {
        return $this->getVar('logger');
    }

    public function setLogger(Logger $logger)
    {
        return $this->logger = $logger;
    }

    public function getSettings()
    {
        $settings = $this->getVar('settings');
        return $settings->getInstance();
    }

    private function getVar($name) {
        if (is_null($this->$name)) {
            $class = 'phMagick\Core\\' . ucfirst($name);
            $this->$name = new $class();
        }

        return $this->$name;
    }

    function isWindows()
    {
        return (!(strstr(PHP_OS, 'WIN') === FALSE));
    }

    function debug($value = TRUE)
    {
        $this->debug = $value;
        return $this;
    }

    function debugMode()
    {
        return $this->debug;
    }

    private function execute(Command $cmdCls)
    {
        $ret = null;
        $out = array();
        $log = $this->getLogger();
        $cmd = $cmdCls->toString();

        if ($this->isWindows()) {
            $cmd = str_replace('(', '\(', $cmd);
            $cmd = str_replace(')', '\)', $cmd);
        }

        exec($cmd . ' 2>&1', $out, $ret);
        $log->append(array('cmd' => $cmd, 'return' => $ret, 'output' => $out));

        if ($ret != 0) {
            $msg = 'Error #' . $ret . ' while executing "' . $cmd . '"';

            if ($this->debugMode()) {
                $msg .= "\n Debug Log: \n" . $log;
            }

            throw new SystemException($msg);
        }

        return $ret;
    }

    private function runAll()
    {
        $items = $this->getAll();
        $destination = null;

        foreach ($items as $action) {
            if (!is_null($destination)) {
                $action->setSource($destination);
            }

            $this->execute($action->getShellCommand());
            $destination = $action->getDestination();
        }
    }

    public function run(Action $action = null)
    {
        if (!is_null($action)) {
            $this->add($action);
        }

        $this->runAll();
    }
}
