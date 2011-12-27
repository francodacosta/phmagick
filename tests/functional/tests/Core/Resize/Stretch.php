<?php
namespace tests\Core\Resize;
use fTest\TestCase;

class Stretch extends TestCase
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/stretch_50_200.jpg';

    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();
        $resizeAction = new \phMagick\Action\Resize\Stretch($this->originalFile, $this->newFile);
        $resizeAction->setWidth(50);
        $resizeAction->setHeight(200);;

        $phMagick->debug(true);
        $phMagick->run($resizeAction);
    }

    public function checkResults()
    {
        return file_exists($this->newFile);
    }

    public function renderResults()
    {
        ?>

                <h2>Stretch Resize</h2>
                <p class="defenition">resize an image ignoring aspect ratio</p>
                <h3>result:</h3>
                <img src="<?php echo $this->newFile?>">
                <h3>code:</h3>
                <div class="code php"><?php echo nl2br($this->getTestCode()) ?></div>
           <?php

        }
}
