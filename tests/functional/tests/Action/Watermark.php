<?php

use fTest\Test\AbstractTest;
use fTest\Test\Result\Success;
use fTest\Test\Result\Failure;

class Watermark extends AbstractTest
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/watermark.jpg';

    public function configure()
    {
        $this->setName("Watermark");
        $this->setTitle("Creating Watermarks");
        $this->setDescription("
            Watermarks are easy to create, this code will overlay an image on
            top of another
        ");
    }

    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();
        $action = new \phMagick\Action\Watermark($this->originalFile, $this->newFile);

        // transparency of the watermark
        $action->setTransparency(70);

        // location of the watermark
        $action->setGravity('center');

        // watermark image (the image to overlay)
        $action->setWatermarkImage('data/watermark.png');

        $phMagick->run($action);
    }

    public function checkTestResult()
    {
        return file_exists($this->newFile) ? new Success: new Failure;
    }

    public function renderResults()
    {
        ?>
            <img src="../<?php echo $this->newFile?>">
       <?php

        }
}
