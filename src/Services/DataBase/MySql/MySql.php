<?php
namespace App\Services\DataBase\MySql;

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

    public function getPDO(): \PDO
    {
        return $this->pdo;
    }

    /**
     * @param string $table
     * @param array $data
     */
    public function save(string $table, array $data): void
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

    /**
     * @param string $table
     * @param array $conditions
     * @return array
     * Array of values from DB
     */
    public function getArrays(string $table, array $conditions = []): array
    {
        $query = "SELECT * FROM `$table` " . ($conditions ? 'WHERE ' . implode(' AND ', array_map(function ($e) {return $e . ' = ?';}, array_keys($conditions))) : '');
        $this->sth = $this->pdo->prepare($query);
        $this->sth->execute(array_values($conditions));
        return $this->sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}