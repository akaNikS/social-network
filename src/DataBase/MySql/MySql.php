<?php
namespace App\DataBase\MySql;

class MySql
{
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var \PDOStatement
     */
    private $sth;
    public function __construct(array $params)
    {
        //todo check params
        $this->pdo = new \PDO('mysql:host=' . $params['host'] . ';dbname=' . $params['name'], $params['user'], $params['password']);
    }

    public function save(string $table, array $data)
    {
        $fields = [];
        $values = [];
        $questions = [];
        foreach ($data as $field => $value)
        {
            $fields[] = $field;
            $values[] = $value;
            $questions[] = '?';
        }
        $query = "INSERT INTO `$table` (" . implode(',', $fields) . ") VALUES (" . implode(',', $questions) . ")";
        $this->sth = $this->pdo->prepare($query);
        $this->sth->execute($values);
    }
}