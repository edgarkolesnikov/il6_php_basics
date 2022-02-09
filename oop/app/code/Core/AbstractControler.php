<?php

namespace Core;

use Helper\DBHelper;

class AbstractControler
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
    }

    protected function render($template)
    {
        include_once PROJECT_ROOT_DIR . '/app/design/parts/header.php';
        include_once PROJECT_ROOT_DIR . '/app/design/' . $template . '.php';
        include_once PROJECT_ROOT_DIR . '/app/design/parts/footer.php';
    }

    protected function isUserLoged()
    {
        return isset($_SESSION['user_id']);
    }

}