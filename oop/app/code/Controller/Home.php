<?php

namespace Controller;

use Core\AbstractControler;

class Home extends AbstractControler
{
    public function index()
    {
        $this->render('parts/home');
    }
}