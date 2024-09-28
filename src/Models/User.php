<?php

namespace App\Models;

class User extends AbstractModel
{
    public string $username;

    public string $password;

    public bool $admin;
}