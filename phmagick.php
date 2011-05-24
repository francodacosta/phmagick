<?php

$bp = realpath(dirname(__FILE__));
$ds = DIRECTORY_SEPARATOR;
require_once  $bp . $ds . 'core' . $ds . 'log.php';
require_once  $bp . $ds . 'core' . $ds . 'cli.php';
require_once  $bp . $ds . 'core' . $ds . 'cmd.php';
require_once  $bp . $ds . 'core' . $ds . 'file.php';
require_once  $bp . $ds . 'core' . $ds . 'core.php';
require_once  $bp . $ds . 'core' . $ds . 'plugin_manager.php';
require_once  $bp . $ds . 'core' . $ds . 'exceptions.php';


/**
 *
 * One point entry to PhMagick
 * Encapsluates PhMagick core classes into an easy to use wrapper
 *
 * @author nuno
 */
class PhMagick{
    private $_core          = NULL;
    private $_fileHandler   = NULL;
    private $_pluginManager = NULL;
    private $_debug         = FALSE;
    private $_cli           = NULL;
    private $_logger        = NULL
    ;
    function __construct($source ='', $dest='')
    {
        //TODO: move creation of this objects outside PhMagick and inject them as dependency, maybe using a settings class
        $this->_fileHandler = new PhMagickFile();
        $this->_core = new PhMagickCore( $this->_fileHandler );
        $f =$this->_fileHandler;
        $p = $f->set(dirname(__FILE__))->add('plugins')->get();
        $this->setPluginManager( new PhMagickPluginManager($p, $f) );

        $this->_logger = new PhMagickLogger();
        $this->_cli = new PhMagickCli($this->_logger);

        $this->source($source);
        $this->destination($dest);

        $this->init();

    }

    private function init()
    {
        $p = $this->getPluginManager();
        $p->loadAll();

    }

    function setLogger(PhMagickLogger $l)
    {
        $this->_logger = $l;
        return $this;
    }

    function getLogger()
    {
        return $this->_logger;
    }

    function debug($value = TRUE)
    {
        $this->_debug = $value;
        return $this;
    }

    function debugMode()
    {
        return $this->_debug ;
    }

    function setPluginManager(PhMagickPluginManager $v)
    {
        $this->_pluginManager = $v;
        return $this;
    }

    function getPluginManager()
    {
        return $this->_pluginManager;
    }

    /**
     * Sets the path to image being manipulated
     * @param string $path
     */
    function setSourceFile($path)
    {
        $this->_core->setSourceFile($path);
        return $this;
    }

    /**
     * Gets the path to image being manipulated
     */
    function getSourceFile()
    {
        return $this->_core->getSourceFile();
    }

    /**
     * Alias to getSourceFile and setSourceFile
     *
     * @param string $path if empty string calls getSourceFile, if not it will call setSourceFile
     */
    function source($path = '')
    {
        if ('' == $path)
        {
            return $this->getSourceFile();
        }

        $this->setSourceFile($path);
        return $this;
    }

	/**
     * Sets the path to image being manipulated
     * @param string $path
     */
    function setDestinationFile($path)
    {
        $this->_core->setDestinationFile($path);
        return $this;
    }

    /**
     * Gets the path to image being manipulated
     */
    function getDestinationFile()
    {
        return $this->_core->getDestinationFile();
    }

    /**
     * Alias to getDestinationFile and setDestinationFile
     *
     * @param string $path if empty string calls getDestinationFile, if not it will call setDestinationFile
     */
    function destination($path = '')
    {
        if ('' == $path)
        {
            return $this->getDestinationFile();
        }

        $this->setDestinationFile($path);
        return $this;
    }

	/**
     * Sets the path to ImageMagick's bin folder
     * @param string $path
     */
    function setBinaryBasePath($path)
    {
        $this->_core->setBinaryBasePath($path);
        return $this;
    }

    /**
     * Gets the path to ImageMagick's bin folder
     */
    function getBinaryBasePath()
    {
        return $this->_core->getBinaryBasePath();
    }

    /**
     * Alias to getBinaryBasePath and setBinaryBasePath
     *
     * @param string $path if empty string calls getBinaryBasePath, if not it will call setBinaryBasePath
     */
    function binary($path = '')
    {
        if ('' == $path)
        {
            return $this->getBinaryBasePath();
        }

        $this->setBinaryBasePath($path);
        return $this;
    }

    function __call($method, $args){
        $plugin = $this->getPluginManager();

        if( ! $plugin->methodExists($method) )
        {
            throw new PhMagickException_NotFound('Undefined Method : ' . $method );
        }

        $className = $plugin->getClassForMethod($method);
        array_unshift($args, $this);
        $ret = call_user_func_array(array($className, $method), $args);

        if($ret === false)
           throw new PhMagickException_ExecutionError('Error executing ' . $classname . '->' . $method . '(' . implode(', ', $args). ')');

        return $ret ;
    }

    function execute(phMagickCmd $cmdCls)
    {
        $ret = null ;
        $out = array();
        $log = $this->getLogger();
        $cmd = $cmdCls->get();

        if($this->_core->isWindows()) {
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

        if($ret != 0)
        {
            $msg = 'Error #' . $ret . ' while executing "' . $cmd . '"';

            if ($this->debugMode())
            {
                $msg .= "\n Debug Log: \n" . $log->toString();
            }

            throw new PhMagickException_CliError ($msg);
        }




        return $ret ;
    }
}
