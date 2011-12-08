<?php
namespace phMagick\Core;

use phMagick\Core\Exception\SystemException;

class Runner
{
    private $logger;
    private $debug;

    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }

    function isWindows()
    {
        return ( !(strstr(PHP_OS,'WIN') === FALSE) );
    }

    function debug($value = TRUE)
    {
        $this->debug = $value;
        return $this;
    }

    function debugMode()
    {
        return $this->debug ;
    }

    public function execute(Command $cmdCls)
    {
        $ret = null ;
        $out = array();
        $log = $this->getLogger();
        $cmd = $cmdCls->get();

        if($this->isWindows()) {
            $cmd= str_replace    ('(','\(',$cmd);
            $cmd= str_replace    (')','\)',$cmd);
        }

        exec( $cmd .' 2>&1', $out, $ret);
        $log->append(
            array(
                'cmd' => $cmd
                ,'return' => $ret
                ,'output' => $out
            )
        );

        if($ret != 0) {
            $msg = 'Error #' . $ret . ' while executing "' . $cmd . '"';

            if ($this->debugMode()) {
                $msg .= "\n Debug Log: \n" . $log->toString();
            }

            throw new SystemException ($msg);
        }

        return $ret ;
    }
}