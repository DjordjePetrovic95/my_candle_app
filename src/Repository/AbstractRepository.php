<?php

namespace App\Repository;

use App\Core\Database;
use App\Models\AbstractModel;
use PDO;

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
        return $this->db->pdo->prepare('SELECT * FROM ' . $this->tableName)->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

    /**
     * @phpstan-return T|null
     */
    public function get(int $id): ?AbstractModel
    {
        $query = $this->db->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id=:id LIMIT 1');
        $query->bindParam(':id', $id);
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
        foreach ($criteria as $key => $value) {
            $query->bindParam(':' . $key, $value);
        }

        return (array) $query->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

    public function delete(int $id): bool
    {
        $query = $this->db->pdo->prepare('DELETE FROM ' . $this->tableName . ' WHERE id=:id');
        $query->bindParam(':id', $id);

        return $query->execute();
    }

    /**
     * @phpstan-param T $object
     * @phpstan-return T
     */
    public function create(AbstractModel $object): AbstractModel
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(' . implode(',', array_map(fn(string $field) => ':' . $field, array_keys(get_object_vars($object)))) . ') VALUES (' . implode(',', array_values(get_object_vars($object))) . ')';
        $query = $this->db->pdo->prepare($sql);

        foreach (get_object_vars($object) as $field => $value) {
            $query->bindParam(':' . $field, $value);
        }
        $query->execute();

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
        $sql = 'UPDATE ' . $this->tableName . ' SET ' . implode(',', array_map(fn(string $field): string => $field . '=:' . $field, array_keys(get_object_vars($object)))) . ' WHERE id=:id';
        $query = $this->db->pdo->prepare($sql);

        foreach (get_object_vars($object) as $field => $value) {
            $query->bindParam(':' . $field, $value);
        }
        $query->execute();

        return $object;
    }
}
