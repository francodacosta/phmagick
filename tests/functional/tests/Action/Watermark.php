<?php
namespace tests\Action;
use fTest\TestCase;

class Watermark extends TestCase
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/watermark.jpg';

    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();
        $action = new \phMagick\Action\Watermark($this->originalFile, $this->newFile);
        $action->setTransparency(70);
        $action->setGravity('center');
        $action->setWatermarkImage('data/watermark.png');

        $phMagick->debug(true);
        $phMagick->run($action);
    }

    public function checkResults()
    {
        return file_exists($this->newFile);
    }

    public function renderResults()
    {
        ?>

                <h2>Watermark</h2>
                <div class="test">
                    <p class="defenition">overlays an image on top of another</p>

                    <h3>code:</h3>
                    <div class="code php"><?php echo nl2br($this->getTestCode()) ?></div>
                    <h3>result:</h3>
                    <img src="<?php echo $this->newFile?>">
                </div>
           <?php

        }
}
