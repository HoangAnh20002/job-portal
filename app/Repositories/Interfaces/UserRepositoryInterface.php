<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function createUser(array $userData);
    public function getAllUsers();

}
