<?php
namespace App\Repositories;
use App\Models\Application;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(User::class);
    }

    public function createUser(array $userData)
    {
        return $this->model->create($userData);
    }

    public function getAllUsers()
    {
        return $this->model->all();
    }
    public function getTotalUsers()
    {
        return $this->model->count();
    }
    public function showApply() {
        $user = Auth::user();
        $jobSeekerId = $user->jobseeker->id;
        return Application::where('jobseeker_id', $jobSeekerId)->with(['postjob'])
            ->get();
    }
}
