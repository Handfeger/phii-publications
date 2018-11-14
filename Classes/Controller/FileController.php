<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 29.11.17
 * Time: 17:07
 */

namespace Ph2\Controller;

use FluidTYPO3\Fluidpages\Controller\PageController;

class FileController extends PageController
{
    public function filesAction($pubId = 0)
    {
        echo $pubId;
        die();
    }
}