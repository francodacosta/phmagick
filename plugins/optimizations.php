<?php
/**
 *
 * This plugin will handle image optimization behaviours
 * @author nuno
 *
 */
class PhMagick_optimizations
{
    /**
     *
     * Sets image quality
     * @param number $quality, image quality (depends on format)
     */
    function quality(PhMagick $p, $quality = 85)
    {
        $cmd = new PhMagickCmd();
        $cmd->param('-quality', $quality);

        $p->addBehaviour('image-optimizations', $cmd);
        return $p;
    }
    
    /**
     * Strips metadata information from image
     */
    function strip(PhMagick $p)
    {
        $cmd = new PhMagickCmd();
        $cmd->option('-strip');

        $p->addBehaviour('image-optimizations', $cmd);
        return $p;
    }
}