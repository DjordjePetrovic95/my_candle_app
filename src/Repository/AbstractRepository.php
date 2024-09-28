<?php

namespace App\Repository;

use App\Core\Database;
use App\Models\AbstractModel;
use PDO;
use ReflectionClass;

/**
 * @template T of AbstractModel
 */
abstract class AbstractRepository
{
    private readonly Database $db;

    /**
     * @phpstan-param class-string<T> $modelClass
     */
    public function __construct(
        private readonly string $modelClass,
        private readonly string $tableName,
    ) {
        $this->db = Database::getInstance();
    }

    /**
     * @phpstan-return list<T>
     */
    public function findAll(): array
    {
        $query = $this->db->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

    /**
     * @phpstan-return T|null
     */
    public function get(int $id): ?AbstractModel
    {
        $query = $this->db->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id=:id LIMIT 1');
        $query->execute(compact('id'));
        $object = $query->fetchObject($this->modelClass);

        return empty($object) ? null : $object;
    }

    /**
     * @phpstan-param array<string, mixed> $criteria
     * @phpstan-param array<string, 'ASC'|'DESC'> $orderBy
     * @phpstan-return T|null
     */
    public function findOneBy(array $criteria, array $orderBy = []): ?AbstractModel
    {
        return $this->findBy($criteria, $orderBy, 1)[0] ?? null;
    }

    /**
     * @phpstan-param array<string, mixed> $criteria
     * @phpstan-param array<string, 'ASC'|'DESC'> $orderBy
     * @phpstan-return list<T>
     */
    public function findBy(array $criteria, array $orderBy = [], int $limit = null, int $offset = null): array
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . implode(' AND ', array_map(fn(string $param): string => $param . '=:' . $param, array_keys($criteria)));

        if (! empty($orderBy)) {
            $sql = 'ORDER BY ';
            $order = [];
            foreach ($orderBy as $field => $direction) {
                $order[] = $field . ' ' . $direction;
            }

            $sql .= implode(', ', $order);
        }

        if (isset($limit)) {
            $sql .= ' LIMIT ' . $limit;
        }

        if (isset($offset)) {
            $sql .= ' OFFSET ' . $offset;
        }

        $query = $this->db->pdo->prepare($sql);
        $query->execute($criteria);

        return (array) $query->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

    public function delete(int $id): bool
    {
        $query = $this->db->pdo->prepare('DELETE FROM ' . $this->tableName . ' WHERE id=:id');

        return $query->execute(compact('id'));
    }

    /**
     * @phpstan-param T $object
     * @phpstan-return T
     */
    public function create(AbstractModel $object): AbstractModel
    {
        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties();
        $data = [];
        foreach ($properties as $property) {
            $data[$property->getName()] = $property->getValue($object);
        }

        $sql = 'INSERT INTO ' . $this->tableName . '(' . implode(',', array_keys($data)) . ') VALUES (' . implode(',', array_map(fn(string $field) => ':' . $field, array_keys($data))) . ')';
        $query = $this->db->pdo->prepare($sql);
        $query->execute($data);

        if (! empty($this->db->pdo->lastInsertId()) && is_numeric($this->db->pdo->lastInsertId())) {
            $object->id = (int) $this->db->pdo->lastInsertId();
        }

        return $object;
    }

    /**
     * @phpstan-param T $object
     * @phpstan-return T
     */
    public function update(AbstractModel $object): AbstractModel
    {
        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties();
        $data = [];
        foreach ($properties as $property) {
            $data[$property->getName()] = $property->getValue($object);
        }

        $sql = 'UPDATE ' . $this->tableName . ' SET ' . implode(',', array_map(fn(string $field): string => $field . '=:' . $field, array_keys($data))) . ' WHERE id=:id';
        $query = $this->db->pdo->prepare($sql);
        $query->execute($data);

        return $object;
    }
}
