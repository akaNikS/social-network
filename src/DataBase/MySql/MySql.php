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
        if (isset($params['host']) && isset($params['name']) && isset($params['user']) && isset($params['password'])) {
            $this->pdo = new \PDO('mysql:host=' . $params['host'] . ';dbname=' . $params['name'], $params['user'], $params['password']);
        } else {
            throw new \Exception('Bad mysql config');
        }
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