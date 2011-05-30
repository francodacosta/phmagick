<?php
class PhMagick_tile
{
    /**
     *
     * Joins several images together
     *
     * @param array $images, the list of images to join
     * @param int $columns
     * @param int $rows
     */
    function tile(PhMagick $p, Array $images, $columns = 0, $rows = 1)
    {
        $f       = new PhMagickFile();
        $cmd     = new PhMagickCmd();
        $binary  = $p->binary() . 'montage';
        $source  = $p->source();
        $dest    = $p->destination();
        $columns = (int) $columns;
        $rows    = (int) $rows ;

        if ( 0 == $columns )
        {
            $columns = count($images);
        }

        if (count($images) < 1)
        {
            throw new PhMagickException_InvalidValue('tile(): please provide images to tile');
        }

        if ($columns < 1)
        {
            throw new PhMagickException_InvalidValue('tile(): Colums must be greater than 1');
        }

        if ($rows < 1)
        {
            throw new PhMagickException_InvalidValue('tile(): Rows must be greater than 1');
        }

        $cmd->option($binary)
            ->param('-geometry', 'x+0+0')
            ->param('-tile', $columns . 'x' . $rows)
            ->set($p->getBehaviour('image-optimizations'))
        ;

        foreach($images as $image)
        {
            $i = $f->set($image)->format()->get();
            $cmd->file($i);
        }

        $cmd->file($dest);

        $p->execute($cmd);
        $p->setSourceFile($dest);
        return $p;
    }
}