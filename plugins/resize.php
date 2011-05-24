<?php
/**
 * Handles image resize
 * @author nuno
 */
class PhMagick_resize
{
    /**
     *
     * Proportional resize of images.
     * if height = 0 the resize is based on the new width
     * if width  = 0 the resize is based on the new height
     * if width and height > 0 image magick will try to match both measurements while keeping the aspect ratio
     *
     * @param int $width, the new width
     * @param int $height, the new height, defaults to 0
     */
    function resize(PhMagick $p, $width, $height = 0)
    {
        $f      = new PhMagickFile();
        $cmd    = new PhMagickCmd();
        $binary = $p->binary() . 'convert';
        $source = $p->source();
        $dest   = $p->destination();

        $w = $width  == 0 ? '' : $width ;
        $h = $height == 0 ? '' : $height ;

        $cmd->option($binary)
            ->set('', $source, true)
            ->param('-scale', $w . 'x' . $h)
            ->option('-strip')
            ->set('', $dest, true)
        ;

        $p->execute($cmd);
    }
}