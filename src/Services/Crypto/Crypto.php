<?php
namespace App\Services\Crypto;

class Crypto
{
    /**
     * @var string
     */
    private $salt;

    public function __construct(string $salt)
    {
        $this->salt = $salt;
    }

    /**
     * Adds salt to the password
     * @param string $password
     * @return string
     */
    public function preparedPassword(string $password): string
    {
        return md5($password . $this->salt, true);
    }
}