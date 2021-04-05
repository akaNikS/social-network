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
}
