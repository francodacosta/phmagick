<?php

use fTest\Test\AbstractTest;
use fTest\Test\Result\Success;
use fTest\Test\Result\Failure;

class Convert extends AbstractTest
{
    private $originalFile = 'data/500px-Kiwi_aka.jpg';
    private $newFile =  'results/converted.png';


    /**
     * Converts an image into another format.
     *
     * You can use this command to convert a file into another.
     * phMagick is smart, so it will guess the correct format from the file extension
     * optionaly you can optimize the image (striping exif tags) and set the final
     * image quality
     *
     */
    public function test()
    {
        $phMagick = new \phMagick\Core\Runner();
        $action = new \phMagick\Action\Convert($this->originalFile, $this->newFile);

        // optimize the image
        $action->optimize();

        // sets image quality
        $action->quality(70);

        // execute the convert action
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
