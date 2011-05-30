<?php
/**
 *
 * This plugin will handle image color transformation
 * @author nuno
 *
 */
class PhMagick_color
{
    
    /**
     * Adds an colored layer to an image (I think)
     * @param type $alphaPercent, layer opacity
     * @param type $color layour color
     * @return PhMagick 
     */
    function colorize(PhMagick $p, $alphaPercent, $color)
    {
        $percent = 100 - (int) $alphaPercent; 
        list ($width, $height) = $p->imageInfo();

        $cmd    = new PhMagickCmd();
        $binary = $p->binary() . 'composite';
        $source = $p->source();
        $dest   = $p->destination();
        
        $cmd->option($binary)
            ->param('-blend', $percent)
            ->file($source)
            ->param('-size', $width .'x'. $height)
            ->option('xc:' . $color)
            ->option('-matte')
            ->file($dest)
        ;

        $p->execute($cmd);
        $p->setSourceFile($dest);
        return  $p ;
        
    }
    
    /**
     *
     * Darkens an image by the given percentage
     * @param int $alphaPercent the percentage by which the image will be darkened
     */
    function darken(PhMagick $p, $alphaPercent)
    {
        return $p->colorize($alphaPercent, 'black');
    }
    
    /**
     *
     * Brighten an image by the given percentage
     * @param int $alphaPercent the percentage by which the image will be darkened
     */
    function brighten(PhMagick $p, $alphaPercent)
    {
        return $p->colorize($alphaPercent, 'white');
    }
    
}