<?php


namespace App\Repositories;

use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function authenticate($credentials): bool
    {
        return Auth::attempt($credentials);
    }
    public function registerUser(array $data)
    {

        $role = Role::where('id', $data['role'])->first();
        $userData = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $role->id,
        ];

        $user = User::create($userData);
        if ($role->name === 'employer') {
            Employer::create(['user_id' => $user->id]);
        } elseif ($role->name === 'job seeker') {
            JobSeeker::create(['user_id' => $user->id]);
        }

        return $user;
    }
}

