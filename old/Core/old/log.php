<?php

class PhMagickLogger {

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
        if ( key_exists($id, $this->_log))
        {
            return $this->_log[$id];
        }

        return NULL;
    }

    function get()
    {
        return $this->_log ;
    }


    protected function _toString($data)
    {
        $ret = '';

        foreach($data as $k => $v)
        {
            if( is_array($v)){
                $ret .= $k . ":\n" . $this->_toString($v);
            }
            else
            {
               $ret .= "$k : $v\n";
            }

        }

        return $ret;
    }

    function toString()
    {
        $data = $this->get();
        $ret = '';
        foreach( $data as $d)
        {
            $ret .= $this->_toString($d);
        }
        return $ret;
    }
}