<?php
require __DIR__ . '/' . 'Core/autoload.php';

use phMagick\Core\AutoLoad;

class phMagick
{
    private $actions = array();
    private $system = null;
    private $settings = null;
    private $logger = null;

    public function __construct()
    {
        $autoLoader = new AutoLoad();
        $autoLoader->setClassPath('phMagick' , __DIR__);
    }

    public function getSystem()
    {
        $settings = $this->getSettings();
        $logger   = $this->getLogger();

        $system = $this->getVar('system');
        $system->setDebug($settings->isDebug());
        $system->setLogger($logger);
        return $system;
    }

    public function getLogger()
    {
        return $this->getVar('logger');
    }

    public function getSettings()
    {
        $settings = new Settings();
        return $settings->getInstance();
    }

    private function getVar($name) {
        if (is_null($this->$var)) {
            $class = ucfirst($var);
            $this->$var = &new $class();
        }

        return $this->$var;
    }

    /**
     * Adds an action to the action stack
     * @param Action $action
     */
    public function add(Action $action)
    {
        $this->actions[] = $action;
    }

    /**
     *
     * Executes the actions on the stack
     * destination of one action becomes the source of another action, so we
     * can chain several actions together
     */
    public function execute()
    {

    }
}