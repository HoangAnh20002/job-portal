<?php
namespace App\Repositories;
use App\Models\PostJob;
use App\Repositories\Interfaces\PostJobRepositoryInterface;


class PostJobsRepository extends BaseRepository implements PostJobRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(PostJob::class);
    }
    public function getTotalPostJobs()
    {
        return $this->model->count();
    }
}
