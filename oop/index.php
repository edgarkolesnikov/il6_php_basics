<?php
include 'vendor/autoload.php';
include 'config.php';
session_start();

//include 'FormHelper.php';
//$data = [
//    'type' => 'text',
//    'name'=> 'name',
//    'placeholder'=> 'Vardas'
//    ];
//$data2 = [
//    'type' => 'text',
//    'name'=> 'last_name',
//    'placeholder'=> 'pavarde'
//    ];
//$data3 = [
//    'type' => 'email',
//    'name'=> 'email',
//    'placeholder'=> 'john@gmail.com'
//    ];
//$data4 = [
//    'type' => 'password',
//    'name'=> 'password',
//    'placeholder'=> '*********'
//];
//$data5 = [
//    'name' => 'name',
//    'option' =>[
//        1 => 'Vilnius',
//        2 => 'Kaunas'
//    ]
//];
//
//$formLogin = new FormHelper('login.php', 'POST');
//$formRegister = new FormHelper('register.php', 'POST');
//
//$formRegister->input($data);
//$formRegister->input($data2);
//$formRegister->input($data3);
//$formRegister->input($data4);
//$formRegister->textArea('comment', 'Komentaras');
//$formRegister->select($data5);
//
//
//$formLogin-> input($data3);
//$formLogin->input($data4);
//
//echo $formLogin->getForm();
//echo '<br>';
//echo $formRegister->getForm();
//$form->getForm();

if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '/'){
    $path = trim($_SERVER['PATH_INFO'],'/');
    echo '<pre>';
    $path = explode('/',$path);
    print_r($path);
    $class = ucfirst($path[0]);
    $method = $path[1];

    //echo 'app/code/Controller/'.$class.'.php';
    //$obj = new $class();

    $class = '\Controller\\'.$class;
    if(class_exists($class)){           //tikrinam ar yra tokia klase
        $obj = new $class();
        if(method_exists($obj, $method)){   //tikrinam ar yra toks metodas
            if(isset($path[2])){
                $obj->$method($path[2]);
            }else{
                $obj ->$method();
            }
        }else{
            echo '404';
        }
    }else{
        echo "404";
    }




}else{
    echo '<h1>Titulinis</h1>';
    print_r($_SESSION);
}