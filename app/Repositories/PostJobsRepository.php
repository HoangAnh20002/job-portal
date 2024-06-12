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
    public function updateStatus($id, $status)
    {
        $postJob = $this->model->find($id);
        $postJob->status = $status;
        $postJob->save();

        return $postJob;
    }

    public function filterStatus($status) {
        $result = $this->model->where('status',$status)->get();
        return $result;
    }
    public function getByServiceId($serviceId)
    {
        return $this->model->where('service_id', $serviceId)->get();
    }
}

