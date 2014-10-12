<?php
namespace phMagick\Core;

class System
{
    private $actions = array();
    private $runner = null;
    private $settings = null;
    private $logger = null;

    public function getRunner()
    {
        $settings = $this->getSettings();
        $logger   = $this->getLogger();
        $runner = $this->getVar('runner');

        $runner->debug($settings->isDebug());
        $runner->setLogger($logger);
        return $runner;
    }

    public function getLogger()
    {
        return $this->getVar('logger');
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
