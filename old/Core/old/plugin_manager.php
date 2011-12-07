<?php
class PhMagickPluginManager
{
    protected $_pluginsFolder = '';
    protected $_fileHandler   = NULL;

    protected $_loadedPlugins = array();
    protected $_availableMethods = array();

    function __construct($folder, PhMagickFile $fileHandler)
    {
        $this->_pluginsFolder = $folder ;
        $this->_fileHandler = $fileHandler;
    }

    function setPluginsFolder($path)
    {
        $this->_pluginsFolder = $this->_fileHandler->set($path)->format()->get();
    }

    function getPluginsFolder()
    {
        return $this->_pluginsFolder;
    }

    function setFileHandler(PhMagickFile $item)
    {
        $this->_fileHandler = $item;
    }
    function getFileHandler()
    {
        return $this->_fileHandler;
    }

    function addMethod($method, $pluginClsName)
    {
        $this->_availableMethods[$method] = $pluginClsName ;
    }

    function getMethods()
    {
        return $this->_availableMethods;
    }

    function getLoadedPlugins()
    {
        return $this->_loadedPlugins;
    }

    function getClassForMethod($method)
    {
        $methods = $this->getMethods();
        if ( key_exists($method, $methods) )
        {
            $plugins = $this->getLoadedPlugins();
            $clsName = $methods[$method];
            if( key_exists($clsName, $plugins) )
            {
                return $plugins[$clsName];
            }
        }
        return FALSE;
    }

    function loadPlugin($plugin)
    {
        include_once $plugin ;
        $name = basename($plugin, '.php');
        $className = 'PhMagick_'.$name ;
        $obj = new $className();
        $this->_loadedPlugins[$name] = $obj ;
        foreach (get_class_methods($obj) as $method )
        {
            $this->addMethod($method, $name);
        }
    }

    function loadAll()
    {
        $f = $this->_fileHandler ;
        $base = $f->set($this->getPluginsFolder())->format()->get();
        $plugins = glob($base . '/*.php');
        foreach($plugins as $plugin)
        {
            $this->loadPlugin($plugin);
        }
    }

    function methodExists($method)
    {
        return key_exists($method, $this->getMethods());
    }

    function pluginExists($plugin)
    {
        return key_exists($plugin, $this->getLoadedPlugins());
    }
}