<?php

namespace Model;

use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Url;
use Model\City;
use Model\User as UserModel;
use Core\AbstractModel;

class User extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'users';

    private $name;

    private $lastName;

    private $email;

    private $password;

    private $phone;

    private $cityId;

    private $city;

    private $active;

    private $count;

    private $roleId;

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCityId()
    {
        return $this->cityId;
    }

    public function setCityId($cityId)
    {
        $this->cityId = $cityId;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }


    public function __construct($id = null)
    {
        if ($id !== null) {
            $this->load($id);
        }
    }

    public function assignData()
    {
        $this->data = [
            'name' => $this->name,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'city_id' => $this->cityId,
            'active' => $this->active,
            'role_id' => $this->roleId
        ];
    }


//    public function count()
//{
//    $email = $_POST['email'];
//    $password = md5($_POST['password']);
//    $user = new UserModel();
//    $data = UserModel::load($user);
//
//    if($data->getEmail == $email && $data->getPassword() != $password){
//        $db = new DBHelper();
//        $users = $db->select()->from('users')->where('email', $email)->get();
//        $users->setCount(+1);
//        $user->save();
//        URL::redirect('user/login');
//
//    } else {
//        $this-> render('user/check');
//    }
//
//}

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id',$id)->getOne();
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->lastName = $data['last_name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->phone = $data['phone'];
        $this->cityId = $data['city_id'];
        $this->active = $data['active'];
        $this->roleId = $data['role_id'];
        $city = new City();
        $this->city = $city->load($this->cityId); // galesim is userio gauti miesto pavadinima o ne tik id.
        return $this;
    }

    public static function checkLoginCredentionals($email, $pass)
    {
        $db = new DBHelper();
        $rez = $db->select('id')
            ->from(self::TABLE)
            ->where('email', $email)
            ->andWhere('password', $pass)
            ->andWhere('active', 1)
            ->getOne();
        return isset($rez['id']) ? $rez['id'] : false;          // cia tas pats  kas if apacioje,
        // jeigu viskas ok: ? - true, : - false

//        if (isset($rez['id'])) {
//            $user = new User();
//            $user->load($rez['id']);
//            if ($user->getActive()) {     //cia sitas if'as kad duotu pranesima jei useris nera aktyvus
//                return $rez['id'];
//            }
//        } else {
//            $_SESSION['message'] = 'Neveikia';
//            return false;
//        }
    }
    public static function getAllUser()
    {
        $db = new DBHelper();
        $data= $db->select()->from(self::TABLE)->get();
        $users = [];
        foreach($data as $element)
        {
            $user = new User();
            $user->load($element['id']);
            $users[] = $user;
        }
        return $users;
    }


//    public function delete($id)
//    {
//        $db = new DBHelper();
//        $db->delete()->from('user')->where('id', $id)->exec();
//    }


}