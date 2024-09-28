<?php

namespace App\Core;

use Exception;
use PDO;

class Database extends Singleton
{
    public readonly PDO $pdo;

    /**
     * @throws Exception
     */
    protected function __construct()
    {
        /** @phpstan-ignore-next-line */
        $this->pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', config('db.host'), config('db.db_name')), config('db.user'), config('db.pass'));
    }
}