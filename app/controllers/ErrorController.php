<?php
declare(strict_types=1);

namespace App\Controller;

class ErrorController extends ControllerBase
{

    public function notFoundAction()
    {
        echo '404 - not found';
    }

    public function serverErrorAction()
    {
        echo 'Server Error';
    }

}

