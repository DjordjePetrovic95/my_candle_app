<?php

namespace App\Repository;

use App\Models\User;

/**
 * @extends AbstractRepository<User>
 */
class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(User::class, 'users');
    }
}