<?php
class phMagick_watermark
{
/**
     * Add's an watermark to an image
     *
     * @param $watermarkImage String - Image path
     * @param $gravity phMagickGravity - The placement of the watermark
     * @param $transparency Integer - 1 to 100 the tranparency of the watermark (100 = opaque)
     */
    function watermark(phmagick $p, $watermarkImage, $gravity = 'center', $transparency = 50){
        //composite -gravity SouthEast watermark.png original-image.png output-image.png
        $cmd   = $p->getBinary('composite');
        $cmd .= ' -dissolve ' . $transparency ;
        $cmd .= ' -gravity ' . $gravity ;
        $cmd .= ' ' . $watermarkImage ;
        $cmd .= ' "' . $p->getSource() .'"' ;
        $cmd .= ' "' . $p->getDestination() .'"' ;

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }
}