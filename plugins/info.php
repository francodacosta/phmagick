<?php
/**
 *
 * This plugin will handle image information
 * @author nuno
 *
 */
class PhMagick_info
{
    /**
     *
     * gets image information
     */
    function imageInfo(PhMagick $p)
    {
       $file = $p->source();
       return getimagesize  ($file);
    }
    
}