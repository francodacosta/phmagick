<?php
/**
 *
 * This plugin will handler border effects on images
 * @author nuno
 *
 */
class PhMagick_border
{
    /**
     *
     * draws a basic border arround an image
     * @param $color, border color, defaults to #000000
     * @param $size, border size, defaults to 1
     */
    function border(PhMagick $p, $color="#000", $size = 1)
    {
        $cmd    = new PhMagickCmd();
        $binary = $p->binary() . 'convert';
        $source = $p->source();
        $dest   = $p->destination();

        $cmd->option($binary)
            ->set('', $source, true)
            ->param('-bordercolor', $color)
            ->param('-border', $size)
            ->set('', $dest, true)
        ;

        $p->execute($cmd);
    }
}