<?php
declare(strict_types=1);
namespace Controller;

use Core\AbstractControler;
use Core\Interfaces\ControllerInterface;

class Error extends AbstractControler implements ControllerInterface
{
    public function index(): void
    {

    }

    public function error404(): Error
    {
        $this->render('parts/errors/error404');
    }
}