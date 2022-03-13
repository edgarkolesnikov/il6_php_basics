<?php

namespace Model;

use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Core\AbstractModel;

class User extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'users';

    private string $name;

    private string $lastName;

    private string $email;

    private string $password;

    private string $phone;

    private int $cityId;

    private object $city;

    private int $active;

    private int $count;

    private int $roleId;



    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }


    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function setCityId(int $cityId): void
    {
        $this->cityId = $cityId;
    }

    public function getCity(): object
    {
        return $this->city;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }


    public function __construct(?int $id = null)
    {
        if ($id !== null) {
            $this->load($id);
        }
    }

    public function assignData(): void
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

    public function load(int $id): object
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
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

    public static function checkLoginCredentionals(string $email, string $pass): ?int
    {
        $db = new DBHelper();
        $rez = $db->select('id')
            ->from(self::TABLE)
            ->where('email', $email)
            ->andWhere('password', $pass)
            ->andWhere('active', 1)
            ->getOne();
        return isset($rez['id']) ? $rez['id'] : null;          // cia tas pats  kas if apacioje,
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
    public static function getAllUser(): array
    {
        $db = new DBHelper();
        $data= $db->select()->from(self::TABLE)->get();
        $users = [];
        foreach($data as $element) {
            $user = new User();
            $user->load((int)$element['id']);
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