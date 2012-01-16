<?php
namespace tests\Action;
use fTest\TestCase;

class SimpleCrop extends TestCase
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/crop_100_100_0_0_center.jpg';

    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();
        $action = new \phMagick\Action\SimpleCrop($this->originalFile, $this->newFile);
        $action->setWidth(70);
        $action->setHeight(100);
        $action->setTop(0);
        $action->setLeft(0);
        $action->setGravity('center');

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

                <h2>Simple Crop</h2>
                <div class="test">
                    <p class="defenition">crops an image</p>

                    <h3>code:</h3>
                    <div class="code php"><?php echo nl2br($this->getTestCode()) ?></div>
                    <h3>result:</h3>
                    <img src="<?php echo $this->newFile?>">
                </div>
           <?php

        }
}
