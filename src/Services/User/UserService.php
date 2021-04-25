<?php
namespace App\Services\User;


use App\Services\DataBase\MySql\MySql;

class UserService
{
    public const USER_TABLE = 'app_users';

    /**
     * @var MySql
     */
    protected $db;

    public function __construct(MySql $db)
    {
        $this->db = $db;
    }

    /**
     * @param $email
     * @return array|null
     */
    public function getUserByEmail($email): ?array
    {
        return $this->db->getArrays(self::USER_TABLE, ['email' => $email])[0] ?? null;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getUserById($id): ?array
    {
        return $this->db->getArrays(self::USER_TABLE, ['id' => $id])[0] ?? null;
    }

    /**
     * @param $email
     * @param $password
     * @param $name
     * @param $surname
     * @param $middleName
     * saves the user to the database
     */
    public function saveUser($email, $password, $name, $surname, $middleName): void
    {
        $this->db->save(
            self::USER_TABLE,
            [
                'email' => $email,
                'password' => $password,
                'name' => $name,
                'surname' => $surname,
                'middle_name' => $middleName
            ]
        );
    }
}
