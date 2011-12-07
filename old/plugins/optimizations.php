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
        
        $cmd    = new PhMagickCmd();
        $binary = $p->binary() . 'convert';
        $source = $p->source();
        $dest   = $p->destination();

        $cmd->option($binary)
            ->file($source)
            ->param('-quality', $quality)
            ->file($dest)
        ;

        $p->execute($cmd);
        $p->setSourceFile($dest);
        return $p;
    }
    
    /**
     * Strips metadata information from image
     */
    function strip(PhMagick $p)
    {
        $cmd    = new PhMagickCmd();
        $binary = $p->binary() . 'convert';
        $source = $p->source();
        $dest   = $p->destination();

        $cmd->option($binary)
            ->file($source)
            ->option('-strip')
            ->file($dest)
        ;

        $p->execute($cmd);
        $p->setSourceFile($dest);
        return $p;
    }
}