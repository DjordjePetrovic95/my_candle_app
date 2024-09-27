<?php

namespace App\Core;

class Database extends Singleton
{
    public readonly \PDO $pdo;

    protected function __construct()
    {
        $this->pdo = new \PDO(
            sprintf('mysql:host=%s;dbname=%s', config('db')['host'], config('db')['db_name']),
            config('db')['user'],
            config('db')['pass']
        );
    }
}