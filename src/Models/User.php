<?php

namespace App\Models;

class User extends AbstractModel
{
    public int $username;

    public string $password;
}