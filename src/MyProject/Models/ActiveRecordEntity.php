<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mapped = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            if ($propertyName === 'id' || $this->$propertyName === null) {
                continue;
            }
            $mapped[$this->camelCaseToUnderscore($propertyName)] = $this->$propertyName;
        }
        return $mapped;
    }

    public function save(): void
    {
        if ($this->id !== null) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    private function update(): void
    {
        $mapped = $this->mapPropertiesToDbFormat();

        $columns = [];
        $params = [];
        $index = 1;
        foreach ($mapped as $column => $value) {
            $param = ':param' . $index;
            $columns[] = '`' . $column . '` = ' . $param;
            $params[$param] = $value;
            $index++;
        }

        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(', ', $columns) . ' WHERE id = ' . $this->id . ';';

        $db = new Db();
        $db->query($sql, $params);
    }

    private function insert(): void
    {
        $mapped = $this->mapPropertiesToDbFormat();

        $columns = [];
        $paramNames = [];
        $params = [];
        $index = 1;
        foreach ($mapped as $column => $value) {
            $param = ':param' . $index;
            $columns[] = '`' . $column . '`';
            $paramNames[] = $param;
            $params[$param] = $value;
            $index++;
        }

        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $paramNames) . ');';

        $db = new Db();
        $db->query($sql, $params);
        $this->id = $db->getLastInsertId();
    }

    public function delete(): void
    {
        $db = new Db();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id;',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    public static function findAll(): array
    {
        $db = new Db();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY id DESC;', [], static::class) ?? [];
    }

    public static function getById(int $id): ?self
    {
        $db = new Db();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    abstract protected static function getTableName(): string;
}
