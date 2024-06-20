<?php
namespace App\Repositories;

use App\Enums\Base;
use App\Models\JobSeeker;
use App\Repositories\Interfaces\JobSeekerRepositoryInterface;


class JobSeekerRepository extends BaseRepository implements JobSeekerRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(JobSeeker::class);
    }
    public function getTotalJobSeekers()
    {
        return $this->model->count();
    }
    public function searchJobSeekers($content)
    {
        $lowercaseContent = strtolower($content);
        return $this->model->whereHas('user', function ($query) use ($lowercaseContent) {
            $query->whereRaw('LOWER(email) LIKE ?', ['%' . $lowercaseContent . '%'])
                ->orWhereRaw('LOWER(username) LIKE ?', ['%' . $lowercaseContent . '%'])
                ->where('role_id',3);
        })
        ->with('user') 
        ->paginate(Base::PAGE);
    }
}
