<?php

declare(strict_types=1);

namespace App\Models;

class User extends AbstractModel
{
    public string $username;

    public string $password;

    public bool $admin;
}
