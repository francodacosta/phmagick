<?php
use fTest\Test\AbstractTest;
use fTest\Test\Result\Success;
use fTest\Test\Result\Failure;

class Stretch extends AbstractTest
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/stretch_50_200.jpg';

    public function configure()
    {
        $this->setName('Resize: Strech');
        $this->setTitle("Thumbnails");
        $this->setDescription("
            Resizes an image ignoring aspect ratio
        ");
    }
    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();

        $resizeAction = new \phMagick\Action\Resize\Stretch($this->originalFile, $this->newFile);
        $resizeAction->setWidth(50);
        $resizeAction->setHeight(200);;

        $phMagick->run($resizeAction);
    }

    public function checkTestResult()
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
