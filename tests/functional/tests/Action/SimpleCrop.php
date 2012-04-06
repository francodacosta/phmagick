<?php
use fTest\Test\AbstractTest;
use fTest\Test\Result\Success;
use fTest\Test\Result\Failure;


class SimpleCrop extends AbstractTest
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/crop_100_100_0_0_center.jpg';

    public function configure()
    {
        $this->setName("Crop");
        $this->setTitle("Cropping images");
        $this->setDescription("
                crops an image
        ");
    }

    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();

        $action = new \phMagick\Action\SimpleCrop($this->originalFile, $this->newFile);
        $action->setWidth(70);
        $action->setHeight(100);
        $action->setTop(0);
        $action->setLeft(0);
        $action->setGravity('center');

        $phMagick->run($action);
    }

    public function checkResults()
    {
        return file_exists($this->newFile) ? new Success: new Failure;
    }

    public function renderResults()
    {
        ?>
            <img src="<?php echo $this->newFile?>">
       <?php

        }
}
