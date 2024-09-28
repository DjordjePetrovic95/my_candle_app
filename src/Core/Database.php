<?php

declare(strict_types=1);

namespace App\Core;

class Database extends Singleton
{
    public readonly \PDO $pdo;

    protected function __construct()
    {
        // @phpstan-ignore-next-line
        $this->pdo = new \PDO(sprintf('mysql:host=%s;dbname=%s', config('db.host'), config('db.db_name')), config(
            'db.user',
            // @phpstan-ignore-next-line
        ), config('db.pass'), [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ]);
    }
}
