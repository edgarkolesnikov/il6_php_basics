<?php

namespace Controller;

use Core\AbstractControler;
use Core\Interfaces\ControllerInterface;

class Error extends AbstractControler implements ControllerInterface
{
    public function index()
    {

    }

    public function error404()
    {
        $this->render('parts/errors/error404');
    }
}