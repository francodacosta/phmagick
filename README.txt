Thank you for downloading phMagick

phMagick needs 2 things to be sucessfully installed

* imagemagick available ate http://www.imagemagick.org
* and php must allow access to the exec() function.

For examples you can browse http://www.francodacosta.com/phmagick there are pleanty of examples there.


Basic Mechanics

phMagick philosophy is extremely simple, you say where is the source image and where you want the new image and then apply actions to it
One great feature of phMagick is that you can apply several actions to an image, making it extremely powerful and able to create very complex images

In the combination example below you will see how easy it is to create a thumbnail with rounded corners and then applying a drop shadow to it.

Enough talking, let's look at some example code to see its simplicity

<?php
    include "phMagick.php";
    $p = new phMagick("source.png","destination.png");
    $p->rotate(45);
?>

In the first line we tell PHP that we are using a file named phMagick.php, it's were phMagick is declared, you only need to do this once.
Line 2 creates a phMagick instance, and say that source.png will be our source image and destination.png will be the new image
Line 3 does the magic, in this case rotates source.png 45 degrees and saves it as destination.png


If you need assistance feel free to mail me at sven @ francodacosta.com .
