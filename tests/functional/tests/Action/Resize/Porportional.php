<?php
/**
 * @author nuno costa nuno@francodacosta.com
 * @copyright
 * @license
 *
 */
use fTest\Test\AbstractTest;
use fTest\Test\Result\Success;
use fTest\Test\Result\Failure;

class Porportional extends AbstractTest
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/resize_100_100.jpg';

    public function configure()
    {
        $this->setName("Resize: Porportional");
        $this->setTitle("Thumbnails");
        $this->setDescription("Resizes an image maintaining aspect ratio");
    }

    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();

        $resizeAction = new \phMagick\Action\Resize\Proportional($this->originalFile, $this->newFile);
        $resizeAction->setWidth(100);

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


