<?php

declare(strict_types=1);

namespace Controller;

use Core\Interfaces\ControllerInterface;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Validator;
use Helper\Url;
use Model\User as UserModel;
use Model\City;
use Core\AbstractControler;

class User extends AbstractControler implements ControllerInterface
{
    public function index(): void
    {
        $this->data['users'] = UserModel::getAllUsers();
        $this->render('user/list');
    }

    public function show(int $id): string
    {
        echo 'User controller ID' . $id;
    }

    public function register(): void  //Registracijos forma
    {
        $form = new FormHelper('user/create', 'POST');
        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas',
        ]);
        $form->input([
            'name' => 'last_name',
            'type' => 'text',
            'placeholder' => 'Pavarde',
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+3706*******',
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'text',
            'placeholder' => 'john@gmail.com'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '********'
        ]);
        $form->input([
            'name' => 'password2',
            'type' => 'password',
            'placeholder' => 'Pakartokite slaptazodi'
        ]);

        $cities = City::getCities();
        $options = [];
        foreach ($cities as $city) {
            $id = $city->getId();
            $options[$id] = $city->getName();
        }
        $form->select(['name' => 'city_id', 'options' => $options]);

        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'register'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('user/register');
    }

    public function login(): void     //Logino forma
    {
        $form = new FormHelper('user/check', 'POST');

        $form->input([
            'name' => 'email',
            'type' => 'text',
            'placeholder' => 'john@gmail.com'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '********'
        ]);

        $form->input([
            'name' => 'login',
            'type' => 'submit',
            'value' => 'login'
        ]);
        $this->data['form'] = $form->getForm();

        $this->render('user/login');
    }

    public function create(): void
    {
        $passMatch = Validator::checkPassword($_POST['password'], $_POST['password2']);
        $isEmailValid = Validator::checkEmail($_POST['email']);
        $isEmailUnic = UserModel::isValueUnic('email',$_POST['email']);
        if ($passMatch && $isEmailValid && $isEmailUnic) {
            $user = new UserModel();
            $user->setName($_POST['name']);
            $user->setLastName($_POST['last_name']);
            $user->setPhone($_POST['phone']);
            $user->setPassword(md5($_POST['password']));
            $user->setEmail($_POST['email']);
            $user->setCityId($_POST['city_id']);
            $user->setActive(1);
            $user->setRoleId(0);
            $user->save();
            Url::redirect('user/login');
        } else {
            echo 'Patikrinkite duomenys';
        }
    }

    public function check(): void
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $userId = UserModel::checkLoginCredentionals($email, $password);
        if ($userId) {
            $user = new UserModel();
            $user->load((int) $userId);
            $_SESSION['loged_in'] = true;
            $_SESSION['user_id'] = $userId;
            $_SESSION['user'] = $user;
            Url::redirect(''); //i homepage nuves mus po logino

        } else {
            Url::redirect('user/login');
        }
    }

    public function edit(): void
    {
        if (!isset($_SESSION['user_id'])) {
            Url::redirect('user/login');
        }

        $userId = $_SESSION['user_id'];
//        print_r($_SESSION);
//        die;
        $user = new UserModel();
        $user->load($userId);

        $form = new FormHelper('user/update', 'POST');
        $form->input([
            'name' => 'name',
            'type' => 'text',
            'value' => $user->getName()
        ]);
        $form->input([
            'name' => 'last_name',
            'type' => 'text',
            'value' => $user->getLastName()
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'value' => $user->getPhone()
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'text',
            'value' => $user->getEmail()
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '********'
        ]);
        $form->input([
            'name' => 'password2',
            'type' => 'password',
            'placeholder' => '********'
        ]);

        $cities = City::getCities();
        $options = [];
        foreach ($cities as $city) {
            $id = $city->getId();
            $options[$id] = $city->getName();
        }
        $form->select([
            'name' => 'city_id',
            'options' => $options,
            'selected'=>$user->getCityId()
            ]);
        $form->input([
            'name' => 'update',
            'type' => 'submit',
            'value' => 'Edit'
        ]);

        $this->data['form'] = $form->getForm();

        $this->render('user/edit');

    }

    public function update(): void
    {
            $userId = $_SESSION['user_id'];
            $user= new UserModel();
            $user->load($userId);
            $user->setName($_POST['name']);
            $user->setLastName($_POST['last_name']);
            $user->setPhone($_POST['phone']);
            $user->setEmail($_POST['email']);
            $user->setCityId((int)$_POST['city_id']);

            if($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'])){
                $user->setPassword(md5($_POST['password']));
            }
            if($user->getEmail() != $_POST['email']){
                if(Validator::checkEmail($_POST['email']) && UserModel::isValueUnic('email', $_POST['email'])){
                    $user->setEmail($_POST['email']);
                }
            }
            $user->save();
            Url::redirect('user/edit');


        $this->render('user/update');
    }

    public function logout(): void
    {
        session_destroy();
        Url::redirect('');
    }


}