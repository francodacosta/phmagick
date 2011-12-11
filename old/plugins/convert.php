<?php
/**
 *
 * This plugin will handle image conversion
 * @author nuno
 *
 */
class PhMagick_convert
{
    function save(PhMagick $p)
    {
        $cmd    = new PhMagickCmd();
        $binary = $p->binary() . 'convert';
        $source = $p->source();
        $dest   = $p->destination();

        $cmd->option($binary)
            ->file($source)
            ->set($p->getBehaviour('image-optimizations'))
            ->file($dest)
        ;

        
        $p->execute($cmd);
        $p->setSourceFile($dest);
        return $p;
    }
    
    function convert(PhMagick $p)
    {
        return $p->save();
    }
}