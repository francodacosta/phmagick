<?php
namespace phMagick\Core;
class Logger
{

    protected $_log = array();

    function clear()
    {
        $this->_log = array();
    }

    function append($data)
    {
        $this->_log[] = $data;
    }

    function getAt($id)
    {
        if (key_exists($id, $this->_log)) {
            return $this->_log[$id];
        }

        return NULL;
    }

    function get()
    {
        return $this->_log;
    }

    /**
     *
     * @todo: revise this crap, arrays are not working properly (or the tests are screwed)
     *
     */

    protected function _toString($data)
    {
        $ret = '';

        if (!is_array($data)) {
            $data = array($data);
        }

        foreach ($data as $k => $v) {

            if (is_array($v)) {
                $ret .= $k . ":\n" . $this->_toString($v);
            } else {
                $ret .= "$v\n";
            }

        }

        return $ret;
    }

    function __toString()
    {
        $data = $this->get();

        $ret = '';
        foreach ($data as $d) {
            $ret .= $this->_toString($d);
        }
        return $ret;
    }
}
