<?php
/**
 *
 * Some basic structures needed by image magick, like Gravity constants or text format
 * @author nuno
 *
 */

class PhMagickGravity{
    const None      = 'None' ;
    const Center    = 'Center' ;
    const East      = 'East' ;
    const Forget    = 'Forget' ;
    const NorthEast = 'NorthEast' ;
    const North     = 'North' ;
    const NorthWest = 'NorthWest' ;
    const SouthEast = 'SouthEast' ;
    const South     = 'South' ;
    const SouthWest = 'SouthWest' ;
    const West      = 'West' ;

    private function __construct(){}
}


class PhMagickText {
    protected $_fontSize   = 12;
    protected $_font       = NULL;
    protected $_color      = '#000';
    protected $_background = NULL;
    protected $_gravity   = 'center'; //ignored in fromString()
    protected $_text      = '';

    function fontSize($i){
        $this->_fontSize = $i ;
        return $this;
    }

    function font($i){
        $this->_font = $i ;
        return $this;
    }

    function color($i){
        $this->_color = $i ;
        return $this;
    }

    function background($i){
        $this->_background = $i ;
        return $this;
    }

    function __get($var){
        $var = '$_' . $var;
        return $this->$var ;
    }

    function gravity( $gravity){
        $this->_gravity = $gravity;
        return $this ;
    }

    function text( $text){
        $this->_text = $text;
        return $this ;
    }
}