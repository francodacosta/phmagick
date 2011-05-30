<?php

/**
 *
 * handles the generation of imagemagick command line
 * it is a dumb class, path to binary, path to source and destination files
 * are not verified, we trust received values are correct
 *
 * @author nuno
 *
 */
class phMagickCmd{

	private $_sourceFile = NULL;
	private $_destFile   = NULL;
	private $_binary     = NULL;
	private $_cmd		 = array();

	protected function _appendToCmd($cmd)
	{
		$args = func_get_args();
		foreach ( $args as $cmd) 
		{
			if( is_a($cmd, 'phMagickCmd') )
			{
				$this->_cmd[] = $cmd->get();
			}
			else
			{
				$this->_cmd[]= $cmd;
			}
		}
		
		
	}

	/**
	 *
	 * Set's an imagemagick value
	 *
	 * @param string $parameter the parameter name
	 * @param string $value the parameter value
	 * param boolean $quotes the parameter value, if present will be surrounded by quotes
	 */
	function set($parameter, $value = '', $quotes = TRUE)
	{
		
		if ( strlen($value) > 0 )
		{
			if ( TRUE == $quotes )
			{
				$value = '"' . $value . '"';
			}

			$value =  $value;
		}

		$this->_appendToCmd($parameter , $value);
		return $this;
	}

	/**
	 * adds a file name to the command list
	 *
	 * @param string $file, the filename
	 */
	function file($file)
	{
	    return $this->set('', $file, TRUE);
	}

	/**
	 * Sets an Parameter
	 *
	 * @param string $parameter the parameter name
	 * @param string $value the parameter value
	 * @param boolean $quotes the parameter value, if present will be surrounded by quotes
	 */
	function param($parameter, $value = '', $quotes = TRUE)
	{
		return $this->set($parameter, $value, $quotes);
	}

	/**
	 * Set's an option (a parameter without a value) Alias for setParameter($option, '', false)
	 *
	 * @param string $option the parameter name
	 */
	function option($option)
	{
		return $this->set($option, '', FALSE);
	}

	/**
	 * returns the shell command, ready to be used in the command line
	 */
	function get()
	{
		return trim(implode(' ', $this->_cmd));
	}
}
