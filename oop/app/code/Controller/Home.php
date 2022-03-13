<?php
declare(strict_types=1);
namespace Controller;

use Core\AbstractControler;
use Core\Interfaces\ControllerInterface;
use Helper\DBHelper;
use Model\Ad;

class Home extends AbstractControler implements ControllerInterface
{
    public function index(): void
    {
        $this->data['latest'] = Ad::getLatest();
        $this->data['populars'] = Ad::getPopularAds(5);
        $this->render('parts/home');
    }


    public function test(): string
    {
        echo "test";
    }



}