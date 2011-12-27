<?php
namespace tests\Core\Resize;
use fTest\TestCase;

class Porportional extends TestCase
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/resize_100_100.jpg';

    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();
        $resizeAction = new \phMagick\Action\Resize\Proportional($this->originalFile, $this->newFile);
        $resizeAction->setWidth(100);

        // $phMagick->debug(true);
        $phMagick->run($resizeAction);
    }

    public function checkResults()
    {
        return file_exists($this->newFile);
    }

    public function renderResults()
    {
        ?>

            <h2>Proportional Resize</h2>
            <p class="description">resize an image maintaining aspect ratio</p>
            <h3>result:</h3>
            <img src="<?php echo $this->newFile?>">
            <h3>code:</h3>
            <div class="code php"><?php echo nl2br($this->getTestCode()) ?></div>
       <?php

    }
}


