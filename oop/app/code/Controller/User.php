<?php

namespace Controller;

use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Validator;
use Helper\Url;
use Model\User as UserModel;
use Model\City;
use Core\AbstractControler;

class User extends AbstractControler
{
    public function show($id)
    {
        echo 'User controller ID' . $id;
    }

    public function register()  //Registracijos forma
    {
//        $db = new DBHelper();
//        $data = [                     Testavimas ar veikia update kodas.
//            'name'=>'Tomas',
//            'last_name' => 'bulve'
//        ];
//        $db->update('users', $data)->where('id', 29)->exec();


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


    public function login()     //Logino forma
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

    public function create()
    {
        $passMatch = Validator::checkPassword($_POST['password'], $_POST['password2']);
        $isEmailValid = Validator::checkEmail($_POST['email']);
        $isEmailUnic = UserModel::emailUnic($_POST['email']);
        if ($passMatch && $isEmailValid && $isEmailUnic) {
            $user = new UserModel();
            $user->setName($_POST['name']);
            $user->setLastName($_POST['last_name']);
            $user->setPhone($_POST['phone']);
            $user->setPassword(md5($_POST['password']));
            $user->setEmail($_POST['email']);
            $user->setCityId($_POST['city_id']);
            $user->setStatus($_POST['active']);
            $user->save();
            Url::redirect('user/login');
        } else {
            echo 'Patikrinkite duomenys';
        }
    }

    public function check()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $userId = UserModel::checkLoginCredentionals($email, $password);
        if ($userId) {
            $user = new UserModel();
            $user->load($userId);
            $_SESSION['loged_in'] = true;
            $_SESSION['user_id'] = $userId;
            $_SESSION['user'] = $user;
            Url::redirect('/'); //i homepage nuves mus po logino

        } else {
            Url::redirect('user/login');
        }
    }

    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            Url::redirect('user/login');
        }

        $userId = $_SESSION['user_id'];
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

    public function update()
    {
            $userId = $_SESSION['user_id'];
            $user= new UserModel();
            $user->load($userId);
            $user->setName($_POST['name']);
            $user->setLastName($_POST['last_name']);
            $user->setPhone($_POST['phone']);
//            $user->setEmail($_POST['email']);
            $user->setCityId($_POST['city_id']);

            if($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'])){
                $user->setPassword(md5($_POST['password']));
            }
            if($user->getEmail() != $_POST['email']){
                if(Validator::checkEmail($_POST['email']) && UserModel::emailUnic($_POST['email'])){
                    $user->setEmail($_POST['email']);
                }
            }
            $user->setStatus($_POST['active']);
            $user->save();
            Url::redirect('user/edit');


        $this->render('user/update');
    }

    public function logout()
    {
        session_destroy();
        Url::redirect('');
    }




}