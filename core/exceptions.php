<?php

class PhMagickException extends Exception {

    function __construct($message){
        $this->message($message);
    }
    function message($message){
        echo '<br><b>phMagick</b>: ' . $message ;
    }
}


class PhMagickException_NotFound extends PhMagickException
{}

class PhMagickException_ExecutionError extends PhMagickException
{}

class PhMagickException_CliError extends PhMagickException
{}

class PhMagickException_InvalidValue extends PhMagickException
{}