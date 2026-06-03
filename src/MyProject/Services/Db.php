<?php

namespace MyProject\Services;

class Db
{
    private $pdo;

    public function __construct()
    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, array $params = [], ?string $className = null): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);

        if ($className === null) {
            return null;
        }

        $result = $sth->fetchAll(\PDO::FETCH_CLASS, $className);
        if ($result === false) {
            return null;
        }
        return $result;
    }

    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }
}
