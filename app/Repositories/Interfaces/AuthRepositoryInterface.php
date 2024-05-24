<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function authenticate($credentials);
    public function registerUser(array $data);

}
