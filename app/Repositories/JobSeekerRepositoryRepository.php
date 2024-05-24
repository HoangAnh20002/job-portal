<?php
namespace App\Repositories;
use App\Models\JobSeeker;
use App\Repositories\Interfaces\JobSeekerRepositoryInterface;


class JobSeekerRepositoryRepository extends BaseRepository implements JobSeekerRepositoryInterface
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
}
